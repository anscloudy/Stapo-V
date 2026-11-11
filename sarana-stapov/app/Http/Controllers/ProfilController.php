<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{
    public function edit()
    {
        $kelas = Lokasi::where('tipe', 'kelas')->orderBy('nama')->pluck('nama');
        return view('profil', ['user' => auth()->user(), 'kelas' => $kelas]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => ['required', 'email', 'max:120', Rule::unique('users')->ignore($user->id)],
            'kelas'    => 'nullable|string|max:60',
            'phone'    => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        if (empty($data['password'])) unset($data['password']);

        $user->update($data);
        return back()->with('ok', 'Profil diperbarui.');
    }
}
