@extends('layouts.app')

@section('title', 'Edit Product')
@section('page_title', 'Edit Product')

@section('content')
    <div class="mx-auto" style="max-width: 48rem;">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h3 class="h6 fw-semibold mb-0">Edit Product</h3>
                <p class="small text-muted mb-0">Update the details of your product.</p>
            </div>
            <form action="/products/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12 col-sm-6">
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required class="form-control">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="sku" class="form-label">SKU</label>
                            <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}" placeholder="e.g PROD-001" required class="form-control">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" required class="form-control">
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $product->quantity) }}" required class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="image" class="form-label">Product Image</label>
                            @if($product->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded" style="width: 80px; height: 80px; object-fit: cover;">
                                </div>
                            @endif
                            <input type="file" name="image" id="image" accept="image/*" class="form-control">
                            <div class="form-text">JPG, PNG, GIF, WEBP. Max 2MB. Leave empty to keep current image.</div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white d-flex align-items-center gap-2">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                    <a href="/dashboard" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection