<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatAntrians;
use App\Models\Video;

class PlasmaController extends Controller
{
    public function index()
    {
        $video = Video::latest()->get()->unique('path')->values()->all();

        // Ambil semua antrian yang belum dipanggil, urut dari terkecil
        $antrianBelumDipanggil = RiwayatAntrians::where('dipanggil', false)
            ->orderBy('id')
            ->get();


        // Ambil antrian yang sedang dipanggil (jika ada)
        $antrian = null;
        if (session()->has('terakhir_dipanggil_id')) {
            $antrian = RiwayatAntrians::find(session('terakhir_dipanggil_id'));
            session(['dipanggil' => $antrian->id]);
        }

        return view('fe.plasma', compact('antrianBelumDipanggil', 'antrian', 'video'));
    }

    



}
