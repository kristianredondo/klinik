<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi data login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba melakukan autentikasi
        if (Auth::attempt($credentials)) {
            // Jika berhasil, arahkan ke dashboard atau halaman setelah login
            return redirect()->intended('/dashboard');
        } else {
            // Jika gagal, kembali ke halaman login dengan pesan error
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi data registrasi
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Buat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Otomatis login setelah registrasi
        Auth::attempt($request->only('email', 'password'));

        // Redirect ke dashboard atau halaman setelah login
        return redirect('/dashboard');
    }
}
