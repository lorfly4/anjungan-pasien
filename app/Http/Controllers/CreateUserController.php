<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CreateUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();
        $users = \App\Models\User::all();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(5);

        return view('cms.table.tablecreateuser', compact('users'));
    }

    public function showcreateuser()
    {
        $users = \App\Models\User::all();
        return view('cms.backend.createuser', compact('users'));
    }

    public function prosescreateuser(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,png|max:2048',
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required',
        ]);

        $file = $request->file('foto');
        $filename = time() . '.' . $file->extension();
        $path = $file->storeAs('images', $filename, 'public');

        $user = new \App\Models\User();
        $user->image = $filename; // pastikan ini nama kolom di database
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->route('createuser.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edituser($id)
    {
        $users = \App\Models\User::findOrFail($id);
        return view('cms.backend.edituser', compact('users'));
    }

    public function updateuser(Request $request, $id)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'nullable',
        ]);

        $users = \App\Models\User::findOrFail($id); // <-- pindah ke atas

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('images', $filename, 'public');
            $users->image = $filename;
        }

        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->role = $request->input('role');

        if ($request->filled('password')) {
            $users->password = bcrypt($request->input('password'));
        }

        $users->save();

        return redirect()->route('createuser.index')->with('success', 'User berhasil diperbarui.');
    }

    public function deleteuser($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->delete();

        return redirect()->route('createuser.index')->with('success', 'User berhasil dihapus.');
    }
}
