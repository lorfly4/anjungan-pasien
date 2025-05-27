<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class awalController extends Controller
{
    public function index(){
        return view("home");
    }

    public function print(){
    $lastAntrian = DB::table('riwayat_antrians')
        ->select('no_antrian')
        ->whereRaw('DATE(tanggal_antrian) = CURRENT_DATE')
        ->orderBy('id', 'desc')
        ->first();

    $nextNumber = 1;
    if ($lastAntrian) {
        // Extract the sequential number from the last antrian
        $lastNumber = (int) substr($lastAntrian->no_antrian, 1);
        $nextNumber = $lastNumber + 1;
    }

    // Generate a unique code, e.g., a random letter combination
    $uniqueCode = 'A';

    $data = $uniqueCode . $nextNumber;

return view("umum.printAntrian", [
    'data' => [
        'no_antrian' => $data
    ],
    'pasien' => null,
    'poli' => null,
    'dokter' => null
]);
    }

}
