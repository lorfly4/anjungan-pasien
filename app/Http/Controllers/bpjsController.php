<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use App\Models\Loket;
use App\Models\riwayat_antrian;
use Carbon\Carbon;

class bpjsController extends Controller
{
    public function index(){
        return view('bpjs.index');
    }

    public function validasiUser(Request $request){
        $request->validate([
            'validasi' => 'required',
        ]);

        $validasi_pasien = $request->input('validasi');

        $data = [
            'no_antrian' => 'B' . (DB::table('riwayat_antrians')
            ->whereRaw('DATE(tanggal_antrian) = CURRENT_DATE')
            ->count() + 1),
        ];

        if($validasi_pasien == 'lama'){
            return redirect('/bpjs/lama');
        }else if($validasi_pasien == 'baru'){
            return redirect('/bpjs/baru');
        }else{
            return view('bpjs.printAntrian', ['data' => $data]);
        }
    }

    public function pasien_lama_bpjs(){
        return view('bpjs.lama');
    }
    public function pasien_baru_bpjs(){
        return view('bpjs.baru');
    }

    public function pasien_baru_bpjs_input(Request $request){
        $request->validate([
            'validasi' => 'required',
        ]);

        $validasi_input = $request->input('validasi');

        if($validasi_input == 'Rujukan Rumah Sakit'){
            return view('bpjs.rujukan');
        }else if($validasi_input == 'daftar'){
            return view('bpjs.buatPasienBaru');
        }else{
            return view('bpjs.printAntrian');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'nik' => ['required', 'digits_between:14,20'],
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'nullable|email',
        ]);

        $tanggal_lahir = $request->tanggal_lahir;
        $tanggal = date('d', strtotime($tanggal_lahir));
        $bulan = date('m', strtotime($tanggal_lahir));
        $tahun = date('y', strtotime($tanggal_lahir));

        $jumlah_pasien = DB::table('pasien_bpjs')->count() + 1;
        $kode_sekuensial = str_pad($jumlah_pasien, 3, '0', STR_PAD_LEFT);

        $no_rm = "B" . $kode_sekuensial . $tanggal . $bulan . $tahun;

        $data = [
            'no_rm' => $no_rm,
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'tanggal_daftar' => now(),
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'email' => $request->email ?? null,
        ];

        $insert = DB::table('pasien_bpjs')->insert($data);

        if ($insert) {
            session(['pasien' => $data]);
            return view('bpjs.rekap', ['data' => $data]);
        } else {
            return redirect('/bpjs/baru')->with('error', 'Data gagal disimpan!');
        }
    }

    public function registrasi()
    {
        $pasien = session('pasien');
        $poli = \App\Models\poli::with('dokter')->get();
        if (!$pasien || !isset($pasien['nama_lengkap'])) {
            return redirect('/bpjs/baru')->with('error', 'Data pasien tidak ditemukan.');
        }

        return view('bpjs.registrasi', ['pasien' => $pasien, 'poli' => $poli]);
    }

    public function dokter(Request $request){
        $request->validate(['poli'=> 'required']);
        $poli_id = $request->input('poli');
        $pasien = session('pasien');
        session(['poli' => $poli_id]);
        if (!$poli_id) {
            return redirect('/bpjs/baru')->with('error', 'Poli tidak ditemukan.');
        }
        if (!$pasien || !isset($pasien['nama_lengkap'])) {
            return redirect('/bpjs/baru')->with('error', 'Data pasien tidak ditemukan.');
        }

        $poli = \App\Models\poli::find($poli_id);
        if (!$poli) {
            return redirect('/bpjs/baru')->with('error', 'Poli tidak ditemukan.');
        }

        $dokter = \App\Models\dokter::where('id_poli', $poli_id)->get();
        if ($dokter->isEmpty()) {
            return redirect('/bpjs/baru')->with('error', 'Dokter tidak ditemukan.');
        }

        $polis = \App\Models\poli::with('dokter')->get();

        return view('bpjs.dokter', [
            'pasien' => $pasien,
            'poli' => $poli,
            'polis' => $polis,
            'dokter' => $dokter
        ]);
    }

    public function cari_pasien(Request $request)
    {
        $request->validate([
            'nomor' => 'required',
            'tanggal' => 'required|date',
        ]);

        $nik = $request->input('nomor');

        $pasien = DB::table('pasien_bpjs')->where('nik', $nik)->first();

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

            return view('bpjs.rekap', compact('data'));
        } else {
            return redirect('/bpjs/lama')->with('error', 'Data pasien tidak ditemukan.');
        }
    }

    public function previewAntrian(Request $request)
    {
        $request->validate([
            'dokter' => 'required',
        ]);

        $dokter = $request->input('dokter');
        $poli_id = session('poli');
        $pasien = session('pasien');
        if (!$pasien) {
            return redirect('/bpjs/registrasi')->with('error', 'Data pasien tidak ditemukan.');
        }
        if (is_object($pasien)) $pasien = (array) $pasien;

        $poliObj = \App\Models\poli::find($poli_id);
        $nama_poli = $poliObj ? $poliObj->nama_poli : '-';

        // Generate nomor antrian SEMENTARA (belum masuk DB)
        $loket = Loket::with('kategori')->where('jenis_berobat', 'BPJS')->firstOrFail();
        $prefix = $loket->kategori->kategoris ?? 'X';
        $id_loket = $loket->id_lokets;
        $today = Carbon::today();
        $jumlahAntrianHariIni = riwayat_antrian::where('id_lokets', $id_loket)
            ->whereDate('tanggal_antrian', $today)
            ->count();
        $nomorAntrian = $prefix . ($jumlahAntrianHariIni + 1);

        $data = [
            'id_lokets' => $id_loket,
            'no_antrian' => $nomorAntrian,
            'tujuan' => $poli_id,
            'dokter' => $dokter,
            'no_rm' => $pasien['no_rm'] ?? null,
            'nama_pasien' => $pasien['nama_lengkap'] ?? null,
            'tanggal_antrian' => now(),
        ];

        // TAMPILKAN HALAMAN PRINT, TAPI BELUM INSERT KE DB
        return view('bpjs.print', [
            'data' => $data,
            'pasien' => $pasien,
            'poli' => $nama_poli,
            'dokter' => $dokter
        ]);
    }


    public function simpanAntrian(Request $request)
    {
        $data = $request->except('_token');
        DB::table('riwayat_antrians')->insert($data);

        return redirect('/')->with('success', 'Antrian berhasil dicetak dan disimpan!');
    }
}
