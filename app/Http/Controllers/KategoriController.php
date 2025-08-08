<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = \App\Models\Kategori::query()
            ->paginate(5)
            ->appends(['search' => request('search')]);

        return view('cms.table.tablecreatekategori', compact('kategoris'));
    }

    public function showcreatekategori()
    {
        $kategoris = \App\Models\Kategori::all();
        return view('cms.backend.createkategori', compact('kategoris'));
    }

    public function prosescreatekategori(Request $request)
    {
        $request->validate([
            'kategori' => 'required',
        ]);

        $kategori = new \App\Models\Kategori();
        $kategori->kategoris = $request->input('kategori'); // gunakan 'kategori' sesuai name di form
        $kategori->save();

        return redirect()->route('tablecreatekategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function showeditkategori($id_kategoris)
    {
        $kategori = \App\Models\Kategori::findOrFail($id_kategoris);
        return view('cms.backend.editkategori', compact('kategori'));
    }

    public function proseseditkategori(Request $request, $id_kategoris)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        $kategori = \App\Models\Kategori::findOrFail($id_kategoris);
        $kategori->kategoris = $request->input('nama_kategori');
        $kategori->save();

        return redirect()->route('tablecreatekategori.index')->with('success', 'Kategori berhasil diupdate.');
    }

    public function deletekategori($id_kategoris) {

        $kategori = \App\Models\Kategori::findOrFail($id_kategoris);
        $kategori->delete();

        return redirect()->route('tablecreatekategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
