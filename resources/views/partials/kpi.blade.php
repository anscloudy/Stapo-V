@php $tone = $tone ?? 'blue'; @endphp
<div class="kpi">
  <span class="tag t-{{ $tone }}">{{ $tag }}</span>
  <div class="n n-{{ $tone }} {{ !empty($small) ? 'n-sm' : '' }}">{{ $n }}</div>
  <b>{{ $title }}</b>
  <span class="meta">{{ $meta }}</span>
</div>
