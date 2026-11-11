<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'total'    => Laporan::count(),
            'selesai'  => Laporan::where('status', 'selesai')->count(),
            'diproses' => Laporan::pending()->count(),
            'lokasiCount' => Lokasi::count(),
            'jurusan'  => config('stapov.jurusan'),
        ]);
    }

    public function tentang()
    {
        return view('tentang', ['jurusan' => config('stapov.jurusan'), 'lokasi' => Lokasi::where('tipe', '!=', 'kelas')->orderBy('tipe')->orderBy('nama')->get()->groupBy('tipe')]);
    }

    public function panduan() { return view('panduan'); }

    public function cekStatus(Request $request)
    {
        $kode = strtoupper(trim((string) $request->query('kode')));
        $laporan = $kode ? Laporan::with(['lokasi', 'logs'])->where('kode', $kode)->first() : null;
        return view('cek-status', compact('kode', 'laporan'));
    }
}
