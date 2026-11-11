<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }

    public function login(Request $request)
    {
        $data = $request->validate(['identitas' => 'required|string', 'password' => 'required|string']);
        $field = filter_var($data['identitas'], FILTER_VALIDATE_EMAIL) ? 'email' : 'nis_nip';

        if (! Auth::attempt([$field => $data['identitas'], 'password' => $data['password']], $request->boolean('ingat'))) {
            return back()->withErrors(['identitas' => 'Email/NIS atau kata sandi salah.'])->onlyInput('identitas');
        }

        $request->session()->regenerate();
        return redirect()->intended(route(Auth::user()->homeRoute()));
    }

    public function showRegister()
    {
        $kelas = Lokasi::where('tipe', 'kelas')->orderBy('nama')->pluck('nama');
        return view('auth.register', compact('kelas'));
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:100',
            'nis_nip'  => 'required|string|max:30|unique:users,nis_nip',
            'email'    => 'required|email|max:120|unique:users,email',
            'kelas'    => 'required|string|max:60',
            'phone'    => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ], [], ['nis_nip' => 'NIS/NIP']);

        $user = User::create($data + ['role' => 'pelapor']);
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('pelapor.dashboard'))->with('ok', 'Akun berhasil dibuat. Selamat datang!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
