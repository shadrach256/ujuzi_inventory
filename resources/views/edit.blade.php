@extends('layouts.app')

@section('title', 'Edit Product')
@section('page_title', 'Edit Product')

@section('content')
    <div class="mx-auto fade-up" style="max-width: 52rem;">
        <div class="card border-0 shadow-sm">
            <div class="card-header py-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="--stat-grad: linear-gradient(135deg,#f59e0b,#f97316); --stat-glow: rgba(245,158,11,0.3); width: 46px; height: 46px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                    </div>
                    <div>
                        <h3 class="h5 fw-bold mb-0">Edit Product</h3>
                        <p class="small text-muted mb-0">Update the details of your product.</p>
                    </div>
                </div>
            </div>
            <form action="/products/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12 col-sm-6">
                            <label for="name" class="form-label">Product Name</label>
                            <div class="input-icon-group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="M3.3 7 12 12l8.7-5"/><path d="M12 22V12"/></svg>
                                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="sku" class="form-label">SKU</label>
                            <div class="input-icon-group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 7V4h16v3"/><path d="M9 20h6"/><path d="M12 4v16"/></svg>
                                <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}" placeholder="e.g. PROD-001" required class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="price" class="form-label">Price (Shs)</label>
                            <div class="input-icon-group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                                <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" required class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="quantity" class="form-label">Quantity</label>
                            <div class="input-icon-group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6.3 2.5A1.5 1.5 0 0 1 7.7 2h8.6a1.5 1.5 0 0 1 1.4.5l4 5A1.5 1.5 0 0 1 22 8.5v11a1.5 1.5 0 0 1-1.5 1.5h-17A1.5 1.5 0 0 1 2 19.5v-11a1.5 1.5 0 0 1 .4-1l4-5Z"/><path d="M2 8h20"/><path d="M14 2v4"/></svg>
                                <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}" required class="form-control">
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="image" class="form-label">Product Image</label>
                            @if($product->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded" style="width: 80px; height: 80px; object-fit: cover; border-radius: 14px; border: 1px solid var(--border);">
                                </div>
                            @endif
                            <label for="image" class="file-drop d-block w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="mb-2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m17 8-5-5-5 5"/><path d="M12 3v12"/></svg>
                                <div class="file-title">Click to replace image</div>
                                <div class="file-sub">JPG, PNG, GIF, WEBP · Max 2MB · Leave empty to keep current</div>
                            </label>
                            <input type="file" name="image" id="image" accept="image/*" class="d-none">
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white d-flex align-items-center gap-2 py-3">
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path d="M20 6 9 17l-5-5"/></svg>
                        Update Product
                    </button>
                    <a href="/dashboard" class="btn btn-soft">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection