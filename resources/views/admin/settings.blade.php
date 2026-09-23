@extends('admin.layouts.app')
@section('content')
<h1 class="h3 mb-4">Pengaturan Website</h1>
<form method="POST" action="{{ route('admin.settings.update') }}" class="card border-0 shadow-sm"><div class="card-body"><div class="row g-3">@csrf
@foreach(['website_name'=>'Website Name','email'=>'Email','whatsapp'=>'WhatsApp','instagram'=>'Instagram URL','tiktok'=>'TikTok URL','shopee_url'=>'Shopee URL','address'=>'Alamat','google_maps'=>'Google Maps URL'] as $key => $label)<div class="{{ in_array($key, ['address','google_maps'], true) ? 'col-12' : 'col-md-6' }}"><label class="form-label">{{ $label }}</label>@if ($key === 'address')<textarea class="form-control" name="{{ $key }}">{{ old($key, $settings[$key] ?? '') }}</textarea>@else<input class="form-control" type="{{ $key === 'email' ? 'email' : 'text' }}" name="{{ $key }}" value="{{ old($key, $settings[$key] ?? '') }}">@endif</div>@endforeach
</div><button class="btn btn-dark mt-4">Simpan Pengaturan</button></div></form>
@endsection
