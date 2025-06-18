<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatAntrians;

class PlasmaController extends Controller
{
    public function index()
    {
        // Ambil semua antrian yang belum dipanggil, urut dari terkecil
        $antrianBelumDipanggil = RiwayatAntrians::where('dipanggil', false)
            ->orderBy('id')
            ->get();

        // Ambil antrian yang sedang dipanggil (jika ada)
        $antrian = null;
        if (session()->has('terakhir_dipanggil_id')) {
            $antrian = RiwayatAntrians::find(session('terakhir_dipanggil_id'));
        }


        $id_lokets = \App\Models\RiwayatAntrians::select('id_lokets')->distinct()->get();
        
        return view('fe.plasma', compact('antrianBelumDipanggil', 'antrian', 'id_lokets'));
    }

    public function panggil(Request $request)
    {
        if ($request->has('ulang') && session()->has('terakhir_dipanggil_id')) {
            // Panggil ulang antrian terakhir
            $antrian = RiwayatAntrians::find(session('terakhir_dipanggil_id'));
        } else {
            // Ambil antrian baru yang belum dipanggil
            $antrian = RiwayatAntrians::where('dipanggil', false)->orderBy('id')->first();
            if ($antrian) {
                $antrian->dipanggil = true;
                $antrian->save();
                session(['terakhir_dipanggil_id' => $antrian->id]);
            }
        }

        // Ambil ulang daftar antrian belum dipanggil
        $antrianBelumDipanggil = RiwayatAntrians::where('dipanggil', false)
            ->orderBy('id')
            ->get();

        return view('fe.plasma', compact('antrianBelumDipanggil', 'antrian'));
    }

    public function reset()
    {
        RiwayatAntrians::where('dipanggil', true)->update(['dipanggil' => false]);
        session()->forget('terakhir_dipanggil_id');
        return redirect()->route('plasma.index')->with('success', 'Antrian telah direset!');
    }

}
