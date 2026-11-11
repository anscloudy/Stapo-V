@if (session('ok'))<div class="flash ok">{{ session('ok') }}</div>@endif
@if ($errors->any() && !isset($hideErrors))<div class="flash bad">@foreach ($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>@endif
