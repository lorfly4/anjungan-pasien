<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class poli extends Controller
{
    public function index()
    {
        $poli = \App\Models\poli::with('dokter')->get();
        return view('umum.poli', compact('poli'));
    }
}
