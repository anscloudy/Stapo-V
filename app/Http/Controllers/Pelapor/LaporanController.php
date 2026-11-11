<?php

namespace App\Http\Controllers\Pelapor;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LaporanController extends Controller
{
    public function dashboard(Request $request)
    {
        $q = $request->user()->laporans();
        return view('pelapor.dashboard', [
            'aktif'        => (clone $q)->pending()->count(),
            'diverifikasi' => (clone $q)->where('status', 'diverifikasi')->count(),
            'selesai'      => (clone $q)->where('status', 'selesai')->count(),
            'laporans'     => $request->user()->laporans()->with('lokasi')->latest()->take(6)->get(),
        ]);
    }

    public function index(Request $request)
    {
        $laporans = $request->user()->laporans()->with('lokasi')
            ->when($request->status, fn ($q, $s) => $q->where('status', $s))
            ->latest()->paginate(10)->withQueryString();
        return view('pelapor.index', compact('laporans'));
    }

    public function create()
    {
        return view('pelapor.create', [
            'lokasis'  => Lokasi::orderBy('tipe')->orderBy('nama')->get()->groupBy('tipe'),
            'kategori' => config('stapov.kategori'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'lokasi_id'   => 'required|exists:lokasis,id',
            'jenis'       => ['required', Rule::in(['kerusakan', 'kehilangan'])],
            'kategori'    => ['required', Rule::in(config('stapov.kategori'))],
            'nama_barang' => 'required|string|max:120',
            'jumlah'      => 'required|integer|min:1|max:500',
            'deskripsi'   => 'required|string|min:10|max:2000',
            'tingkat'     => ['required', Rule::in(array_keys(Laporan::TINGKAT))],
            'fotos'       => 'required_if:jenis,kerusakan|nullable|array|max:3',
            'fotos.*'     => 'image|mimes:jpg,jpeg,png,webp|max:4096',
        ], [
            'fotos.required_if' => 'Laporan kerusakan wajib menyertakan minimal 1 foto bukti.',
            'fotos.*.image'     => 'Berkas harus berupa gambar.',
            'fotos.*.max'       => 'Ukuran tiap foto maksimal 4 MB.',
        ]);

        $paths = [];
        foreach ($request->file('fotos', []) as $file) {
            $paths[] = $file->store('laporan', 'public');
        }

        $laporan = Laporan::create([
            'user_id' => $request->user()->id,
            'fotos'   => $paths,
            'status'  => 'diajukan',
        ] + collect($data)->except('fotos')->all());

        $laporan->logs()->create(['user_id' => $request->user()->id, 'status' => 'diajukan', 'catatan' => 'Laporan dibuat oleh pelapor.']);

        return redirect()->route('pelapor.laporan.show', $laporan)
            ->with('ok', "Laporan terkirim. Kode laporan Anda: {$laporan->kode}");
    }

    public function show(Request $request, Laporan $laporan)
    {
        abort_unless($laporan->user_id === $request->user()->id, 403);
        $laporan->load(['lokasi', 'logs.user', 'petugas']);
        return view('pelapor.show', compact('laporan'));
    }
}
