<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poli;

class PoliController extends Controller
{
    public function index(Request $request)
    {
        $query = Poli::query();

        // Jika ada input pencarian
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_poli', 'like', '%' . $request->search . '%');
        }

        // Ambil data dengan pagination
        $polis = $query->paginate(5)->appends(['search' => $request->search]);

        return view('cms.table.tablepoli', compact('polis'));
    }

    public function showpoli()
    {
        return view('cms.backend.createpoli');
    }

    public function prosescreatepoli(Request $request)
    {
        // dd($request)->all();

        $request->validate([
            'nama_poli' => 'required',
            'status_poli' => 'required',
        ]);

        $poli = new \App\Models\Poli();
        $poli->nama_poli = $request->input('nama_poli');
        $poli->status_opc_ipc = $request->input('status_poli');
        $poli->save();


        return redirect()->route('poli.index')->with('success', 'Poli berhasil dibuat.');
    }

    public function showeditpoli($id_poli)
    {
        $poli = Poli::findOrFail($id_poli);
        return view('cms.backend.editpoli', compact('poli'));
    }

    public function proseseditpoli(Request $request, $id_poli)
    {
        $request->validate([
            'nama_poli' => 'required',
            'status_poli' => 'required',
        ]);

        $poli = Poli::findOrFail($id_poli);
        $poli->nama_poli = $request->input('nama_poli');
        $poli->status_opc_ipc = $request->input('status_poli');
        $poli->save();

        return redirect()->route('poli.index')->with('success', 'Poli berhasil diupdate.');
    }

    public function deletepoli($id_poli)
    {
        $poli = \App\Models\Poli::findOrFail($id_poli);
        $poli->delete();

        return redirect()->route('poli.index')->with('success', 'User berhasil dihapus.');
    }
}
