<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LokasiController extends Controller
{
    public function index(Request $request)
    {
        $lokasis = Lokasi::withCount('laporans')
            ->when($request->tipe, fn ($q, $t) => $q->where('tipe', $t))
            ->when($request->q, fn ($q, $v) => $q->where('nama', 'like', "%$v%"))
            ->orderBy('tipe')->orderBy('nama')->paginate(20)->withQueryString();
        $edit = $request->filled('edit') ? Lokasi::find($request->edit) : null;
        return view('admin.lokasi', compact('lokasis', 'edit'));
    }

    private function rules(): array
    {
        return [
            'nama'    => 'required|string|max:100',
            'tipe'    => ['required', Rule::in(array_keys(Lokasi::TIPE))],
            'jurusan' => ['nullable', Rule::in(array_keys(config('stapov.jurusan')))],
        ];
    }

    public function store(Request $request)
    {
        Lokasi::create($request->validate($this->rules()));
        return redirect()->route('admin.lokasi.index')->with('ok', 'Lokasi ditambahkan.');
    }

    public function update(Request $request, Lokasi $lokasi)
    {
        $lokasi->update($request->validate($this->rules()));
        return redirect()->route('admin.lokasi.index')->with('ok', 'Lokasi diperbarui.');
    }

    public function destroy(Lokasi $lokasi)
    {
        if ($lokasi->laporans()->exists()) {
            return back()->withErrors(['hapus' => 'Lokasi ini sudah punya laporan, tidak bisa dihapus.']);
        }
        $lokasi->delete();
        return back()->with('ok', 'Lokasi dihapus.');
    }
}
