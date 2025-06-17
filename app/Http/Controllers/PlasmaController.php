<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlasmaController extends Controller
{
    public function index()
    {
        $antriansDipanggil = \App\Models\RiwayatAntrians::where('dipanggil', true)->orderBy('updated_at', 'desc')->get();
        $antrianBelumDipanggil = \App\Models\RiwayatAntrians::where('dipanggil', false)->orderBy('updated_at', 'desc')->get();
        $riwayat = \App\Models\RiwayatAntrians::orderBy('created_at', 'desc')->get();

        return view('fe.plasma', compact('antriansDipanggil', 'antrianBelumDipanggil')); // menampilkan halaman dengan tombol
    }

    public function panggil(Request $request)
    {
        if ($request->has('ulang') && session()->has('terakhir_dipanggil_id')) {
            // Ambil ulang data yang terakhir dipanggil dari session
            $antrian = \App\Models\RiwayatAntrians::find(session('terakhir_dipanggil_id'));
        } else {
            // Ambil antrian baru yang belum dipanggil
            $antrian = \App\Models\RiwayatAntrians::where('dipanggil', false)->orderBy('id')->first();

            if ($antrian) {
                $antrian->dipanggil = true;
                $antrian->save();

                // Simpan ID ke session untuk panggil ulang
                session(['terakhir_dipanggil_id' => $antrian->id]);
            }
        }

        // Ambil daftar yang belum dipanggil (untuk info di tampilan)
        $antriansDipanggil = \App\Models\RiwayatAntrians::where('dipanggil', false)->orderBy('updated_at', 'desc')->get();

        return view('fe.plasma', compact('antrian', 'antriansDipanggil'));
    }



    public function reset()
    {
        \App\Models\RiwayatAntrians::where('dipanggil', true)->update(['dipanggil' => false]);

        return redirect()->route('plasma.index')->with('success', 'Antrian telah direset!');
    }
}
