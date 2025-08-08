<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\TampilanRS; // Model for tampilan_rs table

class RSController extends Controller
{

    public function index()
    {
        $tampilan_rs = TampilanRS::all(); // Fetch all records from tampilan_rs table
        return view('cms.table.tablelogors', compact('tampilan_rs')); // Pass the data to the view
    }

    // Show the form to create RS
    public function create()
    {
        return view('cms.backend.createlogors'); // adjust the path based on your view location
    }

    // Process the form and save data to the database
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_rs' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        if ($request->hasFile('image')) {
            // Proses upload gambar
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('img'), $imageName);
        }

        try {
            // Simpan data ke database
            $rs = new TampilanRS();
            $rs->nama_rs = $validated['nama_rs'];
            $rs->image = $imageName; // Simpan nama gambar
            $rs->save();  // Simpan ke database

            return redirect()->route('rs.index')->with('success', 'RS created successfully!');
        } catch (\Exception $e) {
            Log::error('Error creating RS: ' . $e->getMessage());
            return redirect()->route('rs.create')->with('error', 'Error creating RS.');
        }
    }


    // Edit a record in the tampilan_rs table
    public function edit($id_rs)
    {
        $rs = TampilanRS::where('id_rs', $id_rs)->firstOrFail();
        return view('cms.backend.editlogors', compact('rs'));
    }

    // Update a record in the tampilan_rs table
    public function update(Request $request, $id_rs)
    {
        $rs = TampilanRS::where('id_rs', $id_rs)->firstOrFail();

        $validated = $request->validate([
            'nama_rs' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('img'), $imageName);

            // Delete the old image if it exists
            if ($rs->image && File::exists(public_path('img/' . $rs->image))) {
                File::delete(public_path('img/' . $rs->image));
            }

            $rs->image = $imageName; // Update the new image name
        }

        $rs->nama_rs = $validated['nama_rs'];
        $rs->save();

        return redirect()->route('rs.index')->with('success', 'RS updated successfully!');
    }

    // Delete a record in the tampilan_rs table
    public function destroy($id_rs)
    {
        $rs = TampilanRS::where('id_rs', $id_rs)->firstOrFail();

        // Delete the image
        if ($rs->image && File::exists(public_path('img/' . $rs->image))) {
            File::delete(public_path('img/' . $rs->image));
        }

        $rs->delete();

        return redirect()->route('rs.index')->with('success', 'RS deleted successfully!');
    }

    public function updateStatus($id)
    {
        $tampilanRs = TampilanRs::findOrFail($id); // Cari data berdasarkan ID

        // Toggle status antara 'active' dan 'non-active'
        $tampilanRs->status = $tampilanRs->status == 'active' ? 'non-active' : 'active';
        $tampilanRs->save();

        return redirect()->back()->with('status', 'Status logo berhasil diperbarui!');
    }
}
