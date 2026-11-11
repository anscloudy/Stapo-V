<div class="item">
  <div class="doc">📄</div>
  <div class="gr"><b>{{ $l->nama_barang }}</b><span>{{ $l->lokasi->nama }} · {{ $l->created_at->translatedFormat('d M Y') }} · {{ $l->kode }}</span></div>
  <span class="badge s-{{ $l->status }}">{{ $l->status_label }}</span>
  <a class="lnk" href="{{ $href }}">Detail →</a>
</div>
