@extends('admin.layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4"><div><h1 class="h3 mb-1">{{ $title }}</h1><p class="text-muted mb-0">Data terhubung ke database.</p></div>@if (in_array($module, ['gallery','articles','partnerships','users'], true))<a class="btn btn-dark" href="{{ route("admin.{$module}.create") }}">Tambah</a>@endif</div>
<form class="mb-3" method="GET"><div class="input-group"><input class="form-control" name="search" placeholder="Cari..." value="{{ request('search') }}"><button class="btn btn-outline-dark">Cari</button></div></form>
<div class="card shadow-sm border-0"><div class="table-responsive"><table class="table table-hover align-middle mb-0"><thead class="table-light"><tr>
@if ($module === 'gallery')<th>Gambar</th><th>Judul</th><th>Kategori</th><th>Status</th>
@elseif ($module === 'articles')<th>Judul</th><th>Kategori</th><th>Status</th><th>Diterbitkan</th>
@elseif ($module === 'members')<th>Nama</th><th>Email</th><th>Telepon</th><th>Status</th><th>Terdaftar</th>
@elseif ($module === 'partnerships')<th>Nama</th><th>Bisnis</th><th>Email</th><th>Status</th>
@else<th>Nama</th><th>Email</th><th>Role</th><th>Status</th>@endif
<th class="text-end">Aksi</th></tr></thead><tbody>
@forelse ($items as $item)<tr>
@if ($module === 'gallery')<td>@if ($item->image)<img class="admin-thumb" src="{{ \Illuminate\Support\Str::startsWith($item->image, 'storage/') ? asset($item->image) : (str_starts_with($item->image, 'cms/') ? asset('storage/'.$item->image) : asset($item->image)) }}" alt="{{ $item->title }}">@endif</td><td>{{ $item->title }}</td><td>{{ $item->category ?: '-' }}</td><td>{{ $item->status }}</td>
@elseif ($module === 'articles')<td>{{ $item->title }}</td><td>{{ $item->category ?: '-' }}</td><td>{{ $item->status }}</td><td>{{ optional($item->published_at)->format('d M Y') ?: '-' }}</td>
@elseif ($module === 'members')<td>{{ $item->name }}</td><td>{{ $item->email }}</td><td>{{ $item->phone ?: '-' }}</td><td><form method="POST" action="{{ route('admin.members.status', $item->id) }}" class="d-inline">@csrf @method('PATCH')<select name="status" class="form-select form-select-sm" onchange="this.form.submit()">@foreach (['active','inactive','blocked'] as $status)<option value="{{ $status }}" @selected($item->status === $status)>{{ $status }}</option>@endforeach</select></form></td><td>{{ optional($item->registered_at)->format('d M Y') ?: optional($item->created_at)->format('d M Y') }}</td>
@elseif ($module === 'partnerships')<td>{{ $item->name }}</td><td>{{ $item->business_name ?: '-' }}</td><td>{{ $item->email ?: '-' }}</td><td>{{ $item->status }}</td>
@else<td>{{ $item->name }}</td><td>{{ $item->email }}</td><td>{{ $item->role }}</td><td>{{ $item->status }}</td>@endif
<td class="text-end">@if ($module !== 'members')<a class="btn btn-sm btn-outline-dark" href="{{ route("admin.{$module}.edit", $item->id) }}">Edit</a><form class="d-inline" method="POST" action="{{ route("admin.{$module}.destroy", $item->id) }}" onsubmit="return confirm('Hapus data ini?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Hapus</button></form>@endif</td>
</tr>@empty<tr><td class="text-center text-muted py-4" colspan="6">Belum ada data.</td></tr>@endforelse
</tbody></table></div></div>
<div class="mt-3">{{ $items->links() }}</div>
@endsection
