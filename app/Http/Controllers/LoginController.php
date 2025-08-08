<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    public static function index()
    {
        return view('cms.layout.login');
    }


    public function proseslogin(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Ambil email dan password
        $credentials = $request->only('email', 'password');

        // Coba login
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('dashboard.admindashboard');
            } elseif ($user->role === 'user') {
                return redirect()->route('dashboard.userdashboard');
            } else {
                Auth::logout();
                return back()->withErrors(['role' => 'Role tidak dikenali.']);
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
