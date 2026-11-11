<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when($request->role, fn ($q, $r) => $q->where('role', $r))
            ->when($request->q, fn ($q, $v) => $q->where(fn ($w) => $w->where('name', 'like', "%$v%")->orWhere('email', 'like', "%$v%")->orWhere('nis_nip', 'like', "%$v%")))
            ->orderBy('role')->orderBy('name')->paginate(15)->withQueryString();
        $edit = $request->filled('edit') ? User::find($request->edit) : null;
        return view('admin.users', compact('users', 'edit'));
    }

    private function rules(?User $user = null): array
    {
        return [
            'name'     => 'required|string|max:100',
            'email'    => ['required', 'email', 'max:120', Rule::unique('users')->ignore($user?->id)],
            'nis_nip'  => ['nullable', 'string', 'max:30', Rule::unique('users')->ignore($user?->id)],
            'role'     => ['required', Rule::in(['admin', 'petugas', 'pelapor'])],
            'kelas'    => 'nullable|string|max:60',
            'phone'    => 'nullable|string|max:20',
            'password' => [$user ? 'nullable' : 'required', 'string', 'min:8'],
        ];
    }

    public function store(Request $request)
    {
        User::create($request->validate($this->rules()));
        return redirect()->route('admin.users.index')->with('ok', 'Pengguna ditambahkan.');
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate($this->rules($user));
        if (empty($data['password'])) unset($data['password']);
        if ($user->id === $request->user()->id && $data['role'] !== 'admin') {
            return back()->withErrors(['role' => 'Anda tidak bisa menurunkan peran akun sendiri.']);
        }
        $user->update($data);
        return redirect()->route('admin.users.index')->with('ok', 'Pengguna diperbarui.');
    }

    public function destroy(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) return back()->withErrors(['hapus' => 'Akun sendiri tidak bisa dihapus.']);
        $user->delete();
        return back()->with('ok', 'Pengguna dihapus.');
    }
}
