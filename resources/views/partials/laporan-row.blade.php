<div class="item">
  <div class="gr">
    <span class="tag {{ $l->jenis === 'kerusakan' ? 't-bad' : 't-warn' }}">{{ ucfirst($l->jenis) }}</span>
    <b>{{ $l->nama_barang }}</b>
    <span class="meta">{{ $l->lokasi->nama }} • {{ $l->created_at->translatedFormat('d M Y') }} • {{ $l->kode }}</span>
  </div>
  <div class="act">
    <span class="badge s-{{ $l->status }}">{{ $l->status_label }}</span>
    <a class="lnk" href="{{ $href }}">Detail →</a>
  </div>
</div>
