<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loket;

class LoketController extends Controller
{
    public function index(Request $request)
    {
        $lokets = \App\Models\Loket::when($request->search, function ($query, $search) {
            $query->where('nama_lokets', 'LIKE', "%{$search}%");
        })
            ->paginate(5);

        return view('cms.table.tableloket', [
            'lokets' => $lokets,
        ]);
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
        $validatedData = $request->validate([
            'nama_loket' => 'required',
            'jenis_berobat' => 'required',
            'keterangan' => 'required',
            'kategori' => 'required',
            'dokter' => 'required',
            'poli' => 'required|array',
            'status' => 'required',
        ]);

        // Debugging with dd (dump and die)
        // dd($validatedData);

        $loket = \App\Models\Loket::create([
            'nama_lokets' => $validatedData['nama_loket'],
            'jenis_berobat' => $validatedData['jenis_berobat'],
            'keterangan' => $validatedData['keterangan'],
            'id_kategoris' => $validatedData['kategori'],
            'id_dokter' => $validatedData['dokter'],
            'status' => $validatedData['status'],

        ]);

        $loket->polis()->sync($request->input('poli'));

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



    public function updatestatuslokets(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:true,false',
        ]);

        $lokets = Loket::findOrFail($id);

        // Ubah status menjadi 1 (true) atau 0 (false)
        $lokets->status = $request->status === 'true' ? 1 : 0;
        $lokets->save();

        return redirect()->back()->with('success', 'Status lokets berhasil diperbarui.');
    }



    public function prosesdeleteloket($id_lokets)
    {
        $lokets = \App\Models\Loket::find($id_lokets);
        $lokets->delete();

        return redirect()->route('loket.index')->with('success', 'Data loket berhasil dihapus!');
    }
}
