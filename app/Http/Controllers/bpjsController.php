<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        if($validasi_pasien == 'lama'){
            return redirect('/bpjs/lama');
        }else{
            return redirect('/bpjs/baru');
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
        }else if($validasi_input == 'BPJS'){
            return view('bpjs.bpjs');
        }else{
            return view('bpjs.buatPasienBaru');
        }
    }

    public function store(Request $request){
        $request->validate([
            'no_rm' => 'required',
            'no_bpjs' => 'required',
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
            'no_bpjs' => $request->no_bpjs,
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
            DB::table('pasien_bpjs')->insert($data);

            return redirect('/bpjs')->with('success', 'Data pasien baru berhasil disimpan.');
        } else {
            return redirect('/bpjs/baru')->with('error', 'Gagal menyimpan data pasien baru.');
        }
    }
}
