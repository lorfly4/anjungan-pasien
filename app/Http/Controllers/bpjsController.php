<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
