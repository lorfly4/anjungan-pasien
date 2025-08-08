<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dokter extends Controller
{
    public function index()
    {
        $dokter = \App\Models\dokter::with('poli')->get();
        $poli = \App\Models\poli::with('poli')->get();
        return view('umum.dokter', compact('dokter', 'poli'));
    }

}
