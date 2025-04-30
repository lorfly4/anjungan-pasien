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

    public function store(Request $request){
        $request->validate([
            'no_rm' => 'required',
            'nama_lengkap' => 'required',
            'nik' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required',
        ]);

        $data = [
            'no_rm' => $request->no_rm,
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

        if($data)
        {
            // Simpan data ke database
            DB::table('pasien_umum')->insert($data);

            return redirect('/umum')->with('success', 'Data pasien baru berhasil disimpan.');
        } else {
            return redirect('/umum/baru')->with('error', 'Gagal menyimpan data pasien baru.');
        }
    }
}
