<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\RiwayatAntrians;

class RiwayatantriansController extends Controller
{
    public function showtableriwayatantrian()
    {
        $riwayatantrian = \App\Models\RiwayatAntrians::with('loket')->paginate(10);
        return view('cms.table.tableriwayatantrian', compact('riwayatantrian'));
    }

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


        return view('fe.panggil', compact('antrianBelumDipanggil', 'antrian'));
    }

    public function panggil(Request $request)
    {
        if ($request->has('ulang') && session()->has('terakhir_dipanggil_id')) {
            // Ambil ulang data yang terakhir dipanggil dari session
            $antrian = RiwayatAntrians::find(session('terakhir_dipanggil_id'));
        } else {
            // Ambil antrian baru yang belum dipanggil
            $antrian = RiwayatAntrians::where('dipanggil', false)->orderBy('id')->first();

            if ($antrian) {
                $antrian->dipanggil = true;
                $antrian->save();

                // Simpan ID ke session untuk panggil ulang
                session(['terakhir_dipanggil_id' => $antrian->id]);
            }
        }

        // Ambil daftar yang belum dipanggil (untuk info di tampilan)
        $antrianBelumDipanggil = RiwayatAntrians::where('dipanggil', false)->orderBy('updated_at', 'desc')->get();

        return view('fe.panggil', compact('antrian', 'antrianBelumDipanggil'));
    }


public function reset()
{
    // Reset semua status dipanggil
    \App\Models\RiwayatAntrians::where('dipanggil', true)->update(['dipanggil' => false]);

    // Hapus session terakhir dipanggil
    session()->forget('terakhir_dipanggil_id');

    return redirect()->route('riwayatantrians.index')->with('success', 'Antrian telah direset!');
}

}
