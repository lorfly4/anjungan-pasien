<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TampilanRS; // Model for tampilan_rs table
use Illuminate\Support\Facades\Storage;

class RSController extends Controller
{
    // Show the form to create RS
    public function create()
    {
        return view('cms.backend.createlogors'); // adjust the path based on your view location
    }

    // Process the form and save data to the database
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'nama_rs' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for image
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Store the image and get the file path
            $imagePath = $request->file('image')->store('logos', 'public');
        } else {
            $imagePath = null; // If no image is uploaded, set it to null
        }

        // Create a new record in the tampilan_rs table
        $rs = new TampilanRS();
        $rs->nama_rs = $validated['nama_rs'];
        $rs->image = $imagePath; // Store the image path
        $rs->save();

        // Return a response or redirect
        return redirect()->route('rs.create')->with('success', 'RS created successfully!');
    }
}
