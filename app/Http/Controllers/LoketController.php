<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoketController extends Controller
{
    public function index(Request $request)
    {
        $lokets = \App\Models\Loket::when($request->search, function ($query, $search) {
            $query->where('nama_lokets', 'LIKE', "%{$search}%");
        })
            ->paginate(5);
        return view('cms.table.tableloket', compact('lokets'));
    }

    public function showcreateloket()
    {
        $lokets = \App\Models\Loket::all();
        $dokters = \App\Models\Dokter::all()->unique('nama_dokter');
        $polis = \App\Models\Poli::all();
        $kategoris = \App\Models\Kategori::all();

        return view('cms.backend.createloket', compact('lokets', 'dokters', 'polis', 'kategoris'));
    }

    public function prosescreateloket(Request $request)
    {
        $request->validate([
            'nama_loket' => 'required',
            'jenis_berobat' => 'required',
            'keterangan' => 'required',
            'kategori' => 'required',
            'dokter' => 'required',
            'poli' => 'required',
            'status' => 'required',
        ]);

        \App\Models\Loket::create([
            'nama_lokets' => $request->input('nama_loket'),
            'jenis_berobat' => $request->input('jenis_berobat'),
            'keterangan' => $request->input('keterangan'),
            'id_kategoris' => $request->input('kategori'),
            'id_dokter' => $request->input('dokter'),
            'id_poli' => $request->input('poli'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('loket.index')->with('success', 'Data loket berhasil ditambahkan!');
    }

    public function showeditloket($id_lokets)
    {
        $lokets = \App\Models\Loket::find($id_lokets);
        $dokters = \App\Models\Dokter::all()->unique('nama_dokter');
        $polis = \App\Models\Poli::all();
        $kategoris = \App\Models\Kategori::all();

        return view('cms.backend.editloket', compact('lokets', 'dokters', 'polis', 'kategoris'));
    }

    public function proseseditloket(Request $request, $id_lokets)
    {
        $request->validate([
            'nama_loket' => 'required',
            'jenis_berobat' => 'required',
            'keterangan' => 'required',
            'kategori' => 'required',
            'dokter' => 'required',
            'poli' => 'required',
            'status' => 'required',
        ]);

        $lokets = \App\Models\Loket::find($id_lokets);
        $lokets->update([
            'nama_lokets' => $request->input('nama_loket'),
            'jenis_berobat' => $request->input('jenis_berobat'),
            'keterangan' => $request->input('keterangan'),
            'id_kategoris' => $request->input('kategori'),
            'id_dokter' => $request->input('dokter'),
            'id_poli' => $request->input('poli'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('loket.index')->with('success', 'Data loket berhasil diubah!');
    }
    public function prosesdeleteloket($id_lokets)
    {
        $lokets = \App\Models\Loket::find($id_lokets);
        $lokets->delete();

        return redirect()->route('loket.index')->with('success', 'Data loket berhasil dihapus!');
    }
}
