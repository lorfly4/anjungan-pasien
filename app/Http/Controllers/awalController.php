<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\riwayat_antrian;
use App\Models\Loket;
use App\Models\TampilanRS;
use Carbon\Carbon;

class awalController extends Controller
{
    public function index(){
        $rs = TampilanRS::all();
        return view('home', compact('rs'));
    }

    public function print(){
        $loket = Loket::with('kategori')->where('jenis_berobat', 'UMUM')->firstOrFail();
        $prefix = $loket->kategori->kategoris ?? 'X';
        $id_loket = $loket->id_lokets;
        $today = Carbon::today();
        $jumlahAntrianHariIni = riwayat_antrian::where('id_lokets', $id_loket)
            ->whereDate('tanggal_antrian', $today)
            ->count();
        $nomorAntrian = $prefix . ($jumlahAntrianHariIni + 1);

        return view("umum.printAntrian", [
            'data' => [
                'id_lokets' => $id_loket,
                'no_antrian' => $nomorAntrian,
                'tujuan' => '-',
                'dokter' => '-',
                'no_rm' => '-',
                'nama_pasien' => '-',
                'tanggal_antrian' => now(),
                'jam' => '-',
            ],
        ]);
    }

    public function simpanAntrian(Request $request){
        $data = $request->except('_token');
        DB::table('riwayat_antrians')->insert($data);
        Log::info('Antrian disimpan:', $data);
        session()->forget('pasien');
        session()->forget('poli');
        return redirect('/')->with('success', 'Antrian berhasil dicetak dan disimpan!');
    }

}

