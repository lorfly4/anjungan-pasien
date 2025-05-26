<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokterController extends Controller
{
    public function index(Request $request)
    {
        // dd($request)->all();
        $dokters = \App\Models\Dokter::with('poli')
            ->when($request->search, function ($query, $search) {
                $query->where('nama_dokter', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->paginate(5);
        return view('cms.table.tablecreatedokter', compact('dokters'));
    }

    public function showcreatedokter()
    {
        $poli = \App\Models\Poli::all()->unique('nama_poli');
        return view('cms.backend.createpolidokter', compact('poli'));
    }
    public function prosescreatedokter(Request $request)
    {

        $dokters = \App\Models\Dokter::with('poli');
        $poli = \App\Models\Poli::all();
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'poli_id' => 'required|exists:poli,id_poli', // pakai id_poli
        ]);

        // Simpan file gambar ke storage
        $file = $request->file('foto');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('images', $filename, 'public');

        // Simpan data dokter
        \App\Models\Dokter::create([
            'nama_dokter' => $request->input('name'),
            'id_poli' => $request->input('poli_id'),
            'foto_dokter' => $filename,
        ]);

        return redirect()->route('tablecreatedokter.index')->with('success', 'Dokter berhasil ditambahkan');
    }

    public function showeditdokter($id_dokter) {
        $dokter = \App\Models\Dokter::findOrFail($id_dokter);
        $poli = \App\Models\Poli::all()->unique('nama_poli');
        return view('cms.backend.editcreatepolidokter', compact('poli', 'dokter'));
    }

    public function proseseditdokter(Request $request, $id_dokter)
    {
        $dokter = \App\Models\Dokter::findOrFail($id_dokter);
        $poli = \App\Models\Poli::all();
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'nullable|string|max:255',
            'poli_id' => 'nullable|exists:poli,id_poli', // pakai id_poli
        ]);

        if ($request->file('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('images', $filename, 'public');
            $dokter->foto_dokter = $filename;
        }

        $dokter->nama_dokter = $request->input('name') ?? $dokter->nama_dokter;
        $dokter->id_poli = $request->input('poli_id') ?? $dokter->id_poli;
        $dokter->save();

        return redirect()->route('tablecreatedokter.index')->with('success', 'Dokter berhasil diupdate');
    }


    public function deletedokter($id_dokter) {
        $dokter = \App\Models\Dokter::findOrFail($id_dokter);
        $dokter->delete();

        return redirect()->route('tablecreatedokter.index')->with('success', 'User berhasil dihapus.');
    }

    public function tablecreatejadwaldokter(Request $request) {
        $search = $request->get('search');
        $dokters = \App\Models\Dokter::all();
        $jadwaldokters = \App\Models\JadwalDokter::where(function ($query) use ($search) {
            if ($search) {
                $query->whereHas('dokter', function ($query) use ($search) {
                    $query->where('nama_dokter', 'LIKE', "%{$search}%");
                })
                    ->orWhere('hari', 'LIKE', "%{$search}%")
                    ->orWhere('jam_mulai', 'LIKE', "%{$search}%")
                    ->orWhere('jam_selesai', 'LIKE', "%{$search}%");
            }
        })->paginate(5);

        return view('cms.table.tablecreatejadwaldokter', compact('dokters', 'jadwaldokters', 'search'));
    }

    public function showcreatejadwaldokter(Request $request) {

        $dokters = \App\Models\Dokter::all();
        return view ('cms.backend.createjadwaldokter', compact('dokters'));
    }
}
