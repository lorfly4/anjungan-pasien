<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class umumController extends Controller
{
    public function index(){
        return view('umum.index');
    }

    public function validasiUser(Request $request){
        $request->validate([
            'validasi' => 'required',
        ]);

        $validasi_pasien = $request->input('validasi');

        if($validasi_pasien == 'lama'){
            return redirect('/umum/lama');
        }else{
            return redirect('/umum/baru');
        }
    }

    public function pasien_lama_umum(){
        return view('umum.lama');
    }
    public function pasien_baru_umum(){
        return view('umum.baru');
    }

    public function pasien_baru_umum_input(Request $request){
        $request->validate([
            'validasi' => 'required',
        ]);

        $validasi_input = $request->input('validasi');

        if($validasi_input == 'Rujukan Rumah Sakit'){
            return view('umum.rujukan');
        }else{
            return view('umum.buatPasienBaru');
        }
    }

public function store(Request $request)
{
    $request->validate([
        'nama_lengkap' => 'required',
        'nik' => 'required',
        'jenis_kelamin' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required',
        'no_hp' => 'required',
        'email' => 'required',
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
        'email' => $request->email,
    ];

    $insert = DB::table('pasien_umum')->insert($data);

    if ($insert) {
        // Simpan data pasien ke dalam session
        session(['pasien' => $data]);
        return view('umum.rekap', ['data' => $data]);
    } else {
        return redirect('/umum/baru')->with('error', 'Gagal menyimpan data pasien baru.');
    }
}

public function registrasi()
{
    // Ambil data pasien dari session
    $pasien = session('pasien');

    if (!$pasien || !isset($pasien['nama_lengkap'])) {
        return redirect('/umum/baru')->with('error', 'Data pasien tidak ditemukan.');
    }

    return view('umum.registrasi', ['pasien' => $pasien]);
}

public function dokter(){
    $pasien = session('pasien');

    if (!$pasien || !isset($pasien['nama_lengkap'])) {
        return redirect('/umum/baru')->with('error', 'Data pasien tidak ditemukan.');
    }

    return view('umum.dokter', ['pasien' => $pasien]);
}

public function cari_pasien(Request $request)
{
    $request->validate([
        'nomor' => 'required',
    ]);

    $nomor = $request->input('nomor');

    $pasien = DB::table('pasien_umum')->where(function ($query) use ($nomor) {
        $query->where('nik', $nomor)
            ->orWhere('no_rm', $nomor);
    })->first();

    if ($pasien) {
        $data = [
            'nama_lengkap' => $pasien->nama_lengkap,
            'no_rm' => $pasien->no_rm,
            'nik' => $pasien->nik,
            'jenis_kelamin' => $pasien->jenis_kelamin,
            'tempat_lahir' => $pasien->tempat_lahir,
            'tanggal_lahir' => $pasien->tanggal_lahir,
            'alamat' => $pasien->alamat,
            'no_hp' => $pasien->no_hp,
            'email' => $pasien->email,
            'tanggal_daftar' => $pasien->tanggal_daftar,
        ];

        // Simpan data pasien ke dalam session
        session(['pasien' => $data]);

        return view('umum.rekap', compact('data'));
    } else {
        return redirect('/umum/lama')->with('error', 'Data pasien tidak ditemukan.');
    }
}

    public function printAntrian(Request $request)
{
    $request->validate([
        'tujuan' => 'required',
    ]);

    $pasien = session('pasien');
    if (!$pasien) {
        return redirect('/umum/registrasi')->with('error', 'Data pasien tidak ditemukan.');
    }

    // Jika $pasien adalah objek, ubah menjadi array
    if (is_object($pasien)) {
        $pasien = (array) $pasien;
    }

    $data = [
        'no_rm' => $pasien['no_rm'],
        'no_antrian' => 'A' . (DB::table('riwayat_antrians')
            ->whereRaw('DATE(tanggal_antrian) = CURDATE()')
            ->count() + 1), // Generate nomor antrian sequential
        'tujuan' => $request->tujuan,
        'tanggal_antrian' => now(),
    ];

    // Simpan data antrian ke database
    DB::table('riwayat_antrians')->insert($data);

    return view('umum.print', ['data' => $data, 'pasien' => $pasien]);
}

}
