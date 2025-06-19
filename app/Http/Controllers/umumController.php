<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Models\Loket;
use App\Models\riwayat_antrian; // asumsi kamu punya model ini
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\JadwalDokter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class umumController extends Controller
{
    public function index()
    {
        return view('umum.index');
    }

    public function validasiUser(Request $request)
    {
        $request->validate([
            'validasi' => 'required',
        ]);

        $validasi_pasien = $request->input('validasi');

        $data = [
            'no_antrian' => 'A' . (DB::table('riwayat_antrians')
                ->whereRaw('DATE(tanggal_antrian) = CURRENT_DATE')
                ->count() + 1),
        ];

        if ($validasi_pasien == 'lama') {
            return redirect('/umum/lama');
        } else if ($validasi_pasien == 'baru') {
            return redirect('/umum/baru');
        } else {
            return view('umum.printAntrian', ['data' => $data]);
        }
    }

    public function pasien_lama_umum()
    {
        return view('umum.lama');
    }
    public function pasien_baru_umum()
    {
        return view('umum.baru');
    }

    public function pasien_baru_umum_input(Request $request)
    {
        $request->validate([
            'validasi' => 'required',
        ]);

        $validasi_input = $request->input('validasi');

        if ($validasi_input == 'Rujukan Rumah Sakit') {
            return view('umum.rujukan');
        } else {
            return view('umum.buatPasienBaru');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nik' => ['required', 'digits_between:14,20'],
            'jenis_kelamin' => 'required',
            'status_menikah' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'nullable|email',
        ]);

        // Ambil tanggal lahir
        $tanggal_lahir = $request->tanggal_lahir;
        $tanggal = date('d', strtotime($tanggal_lahir)); // Tanggal lahir (dd)
        $bulan = date('m', strtotime($tanggal_lahir)); // Bulan lahir (mm)
        $tahun = date('y', strtotime($tanggal_lahir)); // Tahun lahir (yy)

        // Hitung jumlah pasien umum yang sudah ada
        $jumlah_pasien = DB::table('pasien_umum')->count() + 1;
        $kode_sekuensial = str_pad($jumlah_pasien, 3, '0', STR_PAD_LEFT); // Format 3 digit (001, 002, dst.)

        // Generate no_rm
        $no_rm = "A" . $kode_sekuensial . $tanggal . $bulan . $tahun;

        $status_menikah = $request->status_menikah;
        if ($status_menikah == 'sudah') {
            if ($request->jenis_kelamin == 'laki-laki') {
                $panggilan = 'MR';
            } else {
                $panggilan = 'MRS';
            }
        } else {
            if ($request->jenis_kelamin == 'laki-laki') {
                $panggilan = 'MR';
            } else {
                $panggilan = 'MS';
            }
        }

        $nama_lengkap = $panggilan . ' ' . $request->nama_lengkap;
         
        $data = [
            'no_rm' => $no_rm,
            'nama_lengkap' => $nama_lengkap,
            'nik' => $request->nik,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tanggal_daftar' => now(),
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email ?? null,
            'status_menikah' => $request->status_menikah,
        ];

        $insert = DB::table('pasien_umum')->insert($data);

        if ($insert) {
            // Simpan data pasien ke dalam session
            session(['pasien' => $data]);
            return view('umum.rekap', ['data' => $data]);
        } else {
            return redirect('/umum/baru')->with('error', 'Data gagal disimpan!');
        }
    }

    public function registrasi()
    {
        // Ambil data pasien dari session
        $pasien = session('pasien');
        $poli = \App\Models\poli::with('dokter')->get();
        if (!$pasien || !isset($pasien['nama_lengkap'])) {
            return redirect('/umum/baru')->with('error', 'Data pasien tidak ditemukan.');
        }

        return view('umum.registrasi', ['pasien' => $pasien, 'poli' => $poli]);
    }

    public function dokter(Request $request)
    {
        $request->validate(['poli' => 'required']);
        $poli_id = $request->input('poli');
        $pasien = session('pasien');
        session(['poli' => $poli_id]);
        if (!$poli_id) {
            return redirect('/umum/baru')->with('error', 'Poli tidak ditemukan.');
        }
        if (!$pasien || !isset($pasien['nama_lengkap'])) {
            return redirect('/umum/baru')->with('error', 'Data pasien tidak ditemukan.');
        }

        // Ambil data poli
        $poli = \App\Models\poli::find($poli_id);
        if (!$poli) {
            return redirect('/umum/baru')->with('error', 'Poli tidak ditemukan.');
        }

        // Ambil dokter yang hanya sesuai dengan poli yang dipilih
        $dokter = \App\Models\dokter::where('id_poli', $poli_id)->get();
        if ($dokter->isEmpty()) {
            return redirect('/umum/baru')->with('error', 'Dokter tidak ditemukan.');
        }

        $polis = \App\Models\poli::with('dokter')->get();

        return view('umum.dokter', [
            'pasien' => $pasien,
            'poli' => $poli, // kirim objek poli, bukan id
            'polis' => $polis,
            'dokter' => $dokter
        ]);
    }

    public function pilihJadwal(Request $request)
    {
        $request->validate([
            'dokter' => 'required',
        ]);
        // Ambil dokter berdasarkan ID, bukan nama!
        $dokter_tarik = $request->input('dokter');
        $dokter = \App\Models\dokter::where('id_dokter', $dokter_tarik)->first();

        // Ambil semua jadwal dokter
        $jadwal = \App\Models\JadwalDokter::where('id_dokter', $dokter->id_dokter)->get();

        $hari_ini = now()->locale('id');
        $nama_hari_ini = $hari_ini->isoFormat('dddd'); // "Senin", "Selasa", dst

        $jadwal_tersedia = [];

        // Ambil jadwal hanya untuk hari ini
        $jadwal_hari = $jadwal->where('hari', $nama_hari_ini);
        foreach ($jadwal_hari as $slot) {
            $mulai = Carbon::parse($slot->jam_mulai);
            $akhir = Carbon::parse($slot->jam_selesai);

            while ($mulai->lt($akhir)) {
                $jam = $mulai->format('H:i');
                $sudah_dipakai = \App\Models\riwayat_antrian::where('dokter', $dokter->nama_dokter)
                    ->whereDate('tanggal_antrian', $hari_ini->toDateString())
                    ->where('jam', $jam)
                    ->exists();
                $jadwal_tersedia[] = [
                    'tanggal' => $hari_ini->toDateString(),
                    'hari' => $nama_hari_ini,
                    'jam' => $jam,
                    'disable' => $sudah_dipakai,
                ];
                                $mulai->addMinutes(30); // tambah 30 menit
            }
        }

        $pasien = session('pasien');
        $poli = session('poli');
        $poliObj = \App\Models\poli::find($poli);

        return view('umum.pilih_jadwal', [
            'jadwal' => $jadwal_tersedia,
            'dokter' => $dokter,
            'pasien' => $pasien,
            'poli' => $poliObj,
        ]);
    }

    // Helper untuk konversi nama hari ke index (0=Senin, dst)
    private function getDayIndex($hari)
    {
        $days = [
            'Senin' => 0,
            'Selasa' => 1,
            'Rabu' => 2,
            'Kamis' => 3,
            'Jumat' => 4,
            'Sabtu' => 5,
            'Minggu' => 6,
        ];
        return $days[$hari] ?? 0;
    }

    public function cari_pasien(Request $request)
    {
        $request->validate([
            'nomor' => 'required',
            'tanggal' => 'required|date',
        ]);

        $nik = $request->input('nomor');

        $pasien = DB::table('pasien_umum')->where('nik', $nik)->first();

        if ($pasien) {
            $data = [
                'nama_lengkap'   => $pasien->nama_lengkap,
                'no_rm'          => $pasien->no_rm,
                'nik'            => $pasien->nik,
                'jenis_kelamin'  => $pasien->jenis_kelamin,
                'tempat_lahir'   => $pasien->tempat_lahir,
                'tanggal_lahir'  => $pasien->tanggal_lahir,
                'alamat'         => $pasien->alamat,
                'no_hp'          => $pasien->no_hp,
                'email'          => $pasien->email,
                'tanggal_daftar' => $pasien->tanggal_daftar,
            ];

            session(['pasien' => $data]);

            return view('umum.rekap', compact('data'));
        } else {
            return redirect('/umum/lama')->with('error', 'Data pasien tidak ditemukan.');
        }
    }

    public function previewAntrian(Request $request)
    {
        $request->validate([
            'dokter' => 'required',
            'jadwal' => 'required',
        ]);

        $dokter = $request->input('dokter');
        $dokterObj = dokter::findOrFail($dokter);
        $nama_dokter = $dokterObj->nama_dokter;
        $poli_id = session('poli');
        $pasien = session('pasien');
        if (!$pasien) {
            return redirect('/umum/registrasi')->with('error', 'Data pasien tidak ditemukan.');
        }
        if (is_object($pasien)) $pasien = (array) $pasien;

        $poliObj = \App\Models\poli::find($poli_id);
        $nama_poli = $poliObj ? $poliObj->nama_poli : '-';

        // Generate nomor antrian SEMENTARA (belum masuk DB)
        $lokets = Loket::with('kategori')->where('jenis_berobat', 'UMUM')->get();
        if ($lokets->count() > 1) {
            $loket = $lokets->random();
        } else {
            $loket = $lokets->firstOrFail();
        }
        $antrian = riwayat_antrian::pluck('no_antrian');
        $prefix = $loket->kategori->kategoris ?? 'X';
        $id_loket = $loket->id_lokets;
        $today = Carbon::today();
        $jumlahAntrianHariIni = riwayat_antrian::whereDate('tanggal_antrian', $today)
            ->count();
        $nomorAntrian = $prefix . ($jumlahAntrianHariIni + 1);

        $data = [
            'id_lokets' => $id_loket,
            'no_antrian' => $nomorAntrian,
            'tujuan' => $poli_id,
            'dokter' => $nama_dokter,
            'no_rm' => $pasien['no_rm'] ?? null,
            'nama_pasien' => $pasien['nama_lengkap'] ?? null,
            'tanggal_antrian' => now(),
            'jam' => $request->input('jadwal'),
        ];
        // echo "<pre>";
        // echo dd($data);
        // echo "</pre>";
        // // TAMPILKAN HALAMAN PRINT, TAPI BELUM INSERT KE DB
        return view('umum.print', [
            'data' => $data,
            'pasien' => $pasien,
            'poli' => $nama_poli,
            'dokter' => $nama_dokter
        ]);
    }


    public function simpanAntrian(Request $request)
{
    $data = $request->except('_token');

    DB::table('riwayat_antrians')->insert($data);

    session()->forget('pasien');
    session()->forget('poli');

    return redirect('/')->with('success', 'Antrian berhasil dicetak dan disimpan!');
}

}
    