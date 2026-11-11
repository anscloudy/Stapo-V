<?php

namespace App\Http\Controllers\Kelola;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class LaporanController extends Controller
{
    public function dashboard()
    {
        $perStatus = Laporan::selectRaw('status, count(*) as n')->groupBy('status')->pluck('n', 'status');
        return view('kelola.dashboard', [
            'perStatus' => $perStatus,
            'total'     => $perStatus->sum(),
            'biaya'     => Laporan::where('status', 'selesai')->sum('biaya'),
            'baru'      => Laporan::with(['lokasi', 'pelapor'])->latest()->take(8)->get(),
            'lokasiTop' => Lokasi::withCount('laporans')->has('laporans')->orderByDesc('laporans_count')->take(5)->get(),
        ]);
    }

    public function index(Request $request)
    {
        $laporans = Laporan::with(['lokasi', 'pelapor'])
            ->when($request->status, fn ($q, $v) => $q->where('status', $v))
            ->when($request->jenis, fn ($q, $v) => $q->where('jenis', $v))
            ->when($request->q, fn ($q, $v) => $q->where(fn ($w) => $w
                ->where('kode', 'like', "%$v%")->orWhere('nama_barang', 'like', "%$v%")
                ->orWhereHas('pelapor', fn ($p) => $p->where('name', 'like', "%$v%"))))
            ->latest()->paginate(15)->withQueryString();
        return view('kelola.index', compact('laporans'));
    }

    public function show(Laporan $laporan)
    {
        $laporan->load(['lokasi', 'pelapor', 'petugas', 'logs.user']);
        return view('kelola.show', compact('laporan'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        $data = $request->validate([
            'status'          => ['required', Rule::in(array_keys(Laporan::STATUS))],
            'tingkat'         => ['required', Rule::in(array_keys(Laporan::TINGKAT))],
            'catatan_petugas' => 'nullable|string|max:2000|required_if:status,ditolak',
            'biaya'           => 'nullable|integer|min:0|max:2000000000',
            'jenis_biaya'     => ['nullable', Rule::in(['perbaikan', 'penggantian'])],
            'foto_selesai'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ], ['catatan_petugas.required_if' => 'Alasan penolakan wajib diisi.']);

        $statusLama = $laporan->status;
        $catatanLama = $laporan->catatan_petugas;

        if ($request->hasFile('foto_selesai')) {
            if ($laporan->foto_selesai) Storage::disk('public')->delete($laporan->foto_selesai);
            $data['foto_selesai'] = $request->file('foto_selesai')->store('selesai', 'public');
        } else {
            unset($data['foto_selesai']);
        }

        $data['biaya'] = (int) ($data['biaya'] ?? 0);
        $data['petugas_id'] = $request->user()->id;
        $data['tanggal_selesai'] = $data['status'] === 'selesai' ? ($laporan->tanggal_selesai ?? now()) : null;

        $laporan->update($data);

        if ($statusLama !== $data['status'] || $catatanLama !== ($data['catatan_petugas'] ?? null)) {
            $laporan->logs()->create([
                'user_id' => $request->user()->id,
                'status'  => $data['status'],
                'catatan' => $data['catatan_petugas'] ?? null,
            ]);
        }

        return back()->with('ok', 'Laporan diperbarui.');
    }

    public function destroy(Laporan $laporan)
    {
        foreach ($laporan->fotos ?? [] as $p) Storage::disk('public')->delete($p);
        if ($laporan->foto_selesai) Storage::disk('public')->delete($laporan->foto_selesai);
        $laporan->delete();
        return redirect()->route('kelola.laporan.index')->with('ok', 'Laporan dihapus.');
    }

    // ---- Rekap barang selesai / tertunda + biaya ----
    private function rekapQuery(Request $request)
    {
        return Laporan::with(['lokasi', 'pelapor'])
            ->when($request->dari, fn ($q, $v) => $q->whereDate('created_at', '>=', $v))
            ->when($request->sampai, fn ($q, $v) => $q->whereDate('created_at', '<=', $v))
            ->when($request->status, fn ($q, $v) => $v === 'pending' ? $q->pending() : $q->where('status', $v))
            ->orderBy('created_at');
    }

    public function rekap(Request $request)
    {
        $items = $this->rekapQuery($request)->get();
        return view('kelola.rekap', [
            'items'      => $items,
            'totalBiaya' => $items->where('status', 'selesai')->sum('biaya'),
            'selesai'    => $items->where('status', 'selesai')->count(),
            'tertunda'   => $items->whereIn('status', ['diajukan', 'diverifikasi', 'diproses'])->count(),
        ]);
    }

    public function rekapCsv(Request $request)
    {
        $items = $this->rekapQuery($request)->get();
        return response()->streamDownload(function () use ($items) {
            $out = fopen('php://output', 'w');
            fwrite($out, "\xEF\xBB\xBF");
            fputcsv($out, ['Kode', 'Tanggal', 'Pelapor', 'Lokasi', 'Barang', 'Jenis', 'Status', 'Jenis Biaya', 'Biaya (Rp)', 'Tanggal Selesai']);
            foreach ($items as $l) {
                fputcsv($out, [$l->kode, $l->created_at->format('d/m/Y'), $l->pelapor->name, $l->lokasi->nama, $l->nama_barang,
                    $l->jenis, $l->status_label, $l->jenis_biaya, $l->biaya, optional($l->tanggal_selesai)->format('d/m/Y')]);
            }
            fclose($out);
        }, 'rekap-sarana-stapov-'.now()->format('Ymd').'.csv', ['Content-Type' => 'text/csv']);
    }
}
