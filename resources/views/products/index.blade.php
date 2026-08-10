@extends('layouts.app')

@section('title', 'Product List')
@section('page_title', 'Product List')

@section('content')
    <section class="page-hero fade-up mb-4">
        <div class="d-flex flex-column flex-xl-row align-items-start justify-content-between gap-3">
            <div>
                <span class="hero-greeting">Product Catalog</span>
                <h2>Manage inventory items</h2>
                <p>Browse, update, and organize your product list from one place.</p>
            </div>
            <div class="hero-actions flex-shrink-0">
                <a href="/products/create" class="hero-chip solid">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    Add Product
                </a>
            </div>
        </div>
    </section>

    <div class="card border-0 shadow-sm fade-up">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2 py-3">
            <div>
                <h3 class="h6 fw-semibold mb-0">All Products</h3>
                <p class="small text-muted mb-0">Use the table below to edit stock, update details, and remove items.</p>
            </div>
            <form action="/products" method="GET" class="d-flex align-items-center gap-2 mb-0">
                <input type="search" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Search products, SKUs..." style="min-width: 240px;" autocomplete="off">
                <button type="submit" class="btn btn-soft btn-sm">Search</button>
            </form>
        </div>

        <div class="table-responsive table-app">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Price</th>
                        <th>Available</th>
                        <th>Value</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $p)
                        <tr>
                            <td>
                                <div class="product-cell">
                                    <div class="product-thumb" style="background: {{ $p->image ? 'transparent' : 'var(--primary-grad)' }};">
                                        @if($p->image)
                                            <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}" style="width:100%;height:100%;object-fit:cover;">
                                        @else
                                            {{ strtoupper(substr($p->name, 0, 2)) }}
                                        @endif
                                    </div>
                                    <div>
                                        <p class="name mb-0">{{ $p->name }}</p>
                                        <span class="sku">{{ $p->sku }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="fw-medium">{{ $p->sku }}</td>
                            <td><span class="text-muted small">Shs</span> <span class="fw-bold">{{ number_format($p->price, 0) }}</span></td>
                            <td>
                                <div class="d-flex flex-column gap-2">
                                    <span class="badge badge-soft neutral">{{ $p->quantity }} available</span>
                                    <div class="d-flex align-items-center gap-1 flex-wrap">
                                        <form action="/products/{{ $p->id }}/stock-in" method="POST" class="d-flex align-items-center gap-1 m-0">
                                            @csrf
                                            <input type="number" name="quantity" value="1" min="1" class="form-control form-control-sm" style="width: 64px;">
                                            <button type="submit" class="btn btn-soft btn-sm">In</button>
                                        </form>
                                        <form action="/products/{{ $p->id }}/stock-out" method="POST" class="d-flex align-items-center gap-1 m-0">
                                            @csrf
                                            <input type="number" name="quantity" value="1" min="1" class="form-control form-control-sm" style="width: 64px;">
                                            <button type="submit" class="btn btn-soft btn-sm">Out</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td class="fw-semibold">{{ number_format($p->price * $p->quantity, 0) }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-1 justify-content-end flex-wrap">
                                    <a href="/products/{{ $p->id }}/edit" class="btn-warning-ghost btn-sm" title="Edit">Edit</a>
                                    <form action="/products/{{ $p->id }}" method="POST" class="m-0" onsubmit="return confirm('Delete {{ $p->name }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-danger-ghost btn-sm" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state py-4 text-center">
                                    <p class="mb-2 fw-semibold">No products available yet.</p>
                                    <p class="small text-muted mb-3">Add your first product to begin tracking inventory.</p>
                                    <a href="/products/create" class="btn btn-primary btn-sm">Add Product</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
