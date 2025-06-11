<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatantriansController extends Controller
{
    public function showtableriwayatantrian()
    {
        $riwayatantrian = \App\Models\RiwayatAntrians::with('loket')->paginate(10);
        return view('cms.table.tableriwayatantrian', compact('riwayatantrian'));
    }
}
