@extends('admin.layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Edit Produk</h1>
            <p class="text-muted mb-0">Perbarui data dan link Shopee produk</p>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="{{ route('admin.products.update', $product) }}">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kategori</label>
                        <select name="category_id" class="form-select">
                            <option value="">Pilih kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Gambar</label>
                        <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Harga</label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" class="form-control" min="0" step="1000">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Weight Options</label>
                        <input type="text" name="weight_options" value="{{ old('weight_options', $product->weight_options) }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Body Score</label>
                        <input type="number" name="body_score" value="{{ old('body_score', $product->body_score) }}" class="form-control" min="0" max="100">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Acidity Score</label>
                        <input type="number" name="acidity_score" value="{{ old('acidity_score', $product->acidity_score) }}" class="form-control" min="0" max="100">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Fruity Score</label>
                        <input type="number" name="fruity_score" value="{{ old('fruity_score', $product->fruity_score) }}" class="form-control" min="0" max="100">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Shopee URL</label>
                        <input type="url" name="shopee_url" value="{{ old('shopee_url', $product->shopee_url) }}" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>active</option>
                            <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>inactive</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-dark">Update</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
