<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class sesiController extends Controller
{
    public function index(){
        return view("home");
    }

    public function login(Request $request){
        $request->validate([
            'fUser'=> 'required',
            'fPass'=> 'required'
        ]);

        $cekLogin = [
            'user'=>$request->fUser,
            'password'=>$request->fPass
        ];

        if(Auth::attempt($cekLogin)){
            echo "berhasil";
            exit;
        
        }else{
            echo "gagal";
            exit;
        }
    }
}
