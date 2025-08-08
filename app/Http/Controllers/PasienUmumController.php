<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasienUmumController extends Controller
{
    public function showtablepasienumum ()
    {
        $pasienumum = \App\Models\PasienUmum::all();
        return view('cms.table.tablepasienumum', compact('pasienumum'));
    }

    public function showcreatepasienumum ()
    {
        $pasienumum = \App\Models\PasienUmum::all();
        return view('cms.backend.createpasienumum', compact('pasienumum'));
    }

    public function prosescreatepasienumum (Request $request)
    {
        $request->validate([
            'no_rm' => 'required',
            'nama_pasien' => 'required',
            'nik_pasien' => 'required',
            'jk_pasien' => 'required',
            'tempat_lahir' => 'required',
            'tahun_lahir' => 'required',
            'alamat_pasien' => 'required',
            'no_hp' => 'required',
            'email_pasien' => 'required',
            'status_pasien' => 'required',
        ]);

        $pasienumum = new \App\Models\PasienUmum();
        $pasienumum->no_rm = $request->input('no_rm');
        $pasienumum->nama_lengkap = $request->input('nama_pasien');
        $pasienumum->nik = $request->input('nik_pasien');
        $pasienumum->jenis_kelamin = $request->input('jk_pasien');
        $pasienumum->tempat_lahir = $request->input('tempat_lahir');
        $pasienumum->tanggal_lahir = $request->input('tahun_lahir');
        $pasienumum->alamat = $request->input('alamat_pasien');
        $pasienumum->no_hp = $request->input('no_hp');
        $pasienumum->email = $request->input('email_pasien');
        $pasienumum->tanggal_daftar = now();
        $pasienumum->status_aktif = $request->input('status_pasien');
        $pasienumum->save();

        // dd($request->all());
        return redirect()->route('pasienumum.showtablepasienumum')->with('success', 'Data Pasien Umum Berhasil Ditambahkan');
    }

    public function showeditpasienumum($id_pasien)
    {
        $pasienumum = \App\Models\PasienUmum::find($id_pasien);
        return view ('cms.backend.editpasienumum', compact('pasienumum'));
    }

    public function proseseditpasienumum(Request $request, $id_pasien)
    {
        $request->validate([
            'no_rm' => 'required',
            'nama_pasien' => 'required',
            'nik_pasien' => 'required',
            'jk_pasien' => 'required',
            'tempat_lahir' => 'required',
            'tahun_lahir' => 'required',
            'alamat_pasien' => 'required',
            'no_hp' => 'required',
            'email_pasien' => 'required',
            'status_pasien' => 'required',
        ]);

        $pasienumum = \App\Models\PasienUmum::find($id_pasien);
        $pasienumum->no_rm = $request->input('no_rm');
        $pasienumum->nama_lengkap = $request->input('nama_pasien');
        $pasienumum->nik = $request->input('nik_pasien');
        $pasienumum->jenis_kelamin = $request->input('jk_pasien');
        $pasienumum->tempat_lahir = $request->input('tempat_lahir');
        $pasienumum->tanggal_lahir = $request->input('tahun_lahir');
        $pasienumum->alamat = $request->input('alamat_pasien');
        $pasienumum->no_hp = $request->input('no_hp');
        $pasienumum->email = $request->input('email_pasien');
        $pasienumum->status_aktif = $request->input('status_pasien');
        $pasienumum->save();

        return redirect()->route('pasienumum.showtablepasienumum')->with('success', 'Data Pasien Umum Berhasil Diubah');
    }

    public function deletepasienumum($id_pasien)
    {
        $pasienumum = \App\Models\PasienUmum::find($id_pasien);
        $pasienumum->delete();

        return redirect()->route('pasienumum.showtablepasienumum')->with('success', 'Data Pasien Umum Berhasil Dihapus');
    }
}
