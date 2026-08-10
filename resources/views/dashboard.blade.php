@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
    <!-- Low Stock Alert -->
    @if($lowStockProducts->isNotEmpty())
        <div class="card border-warning bg-warning-subtle">
            <div class="card-body">
                <h3 class="h6 fw-semibold text-warning-emphasis d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    Low Stock Alert
                </h3>
                <div class="row g-2 mt-1">
                    @foreach($lowStockProducts as $product)
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="d-flex align-items-center justify-content-between border border-warning-subtle bg-white rounded px-3 py-2">
                                <div>
                                    <p class="small fw-medium mb-0">{{ $product->name }}</p>
                                    <p class="small text-muted mb-0">{{ $product->sku }}</p>
                                </div>
                                <span class="badge rounded-pill text-bg-danger">{{ $product->quantity }} left</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Products Table -->
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-white d-flex align-items-center justify-content-between py-3">
            <h3 class="h6 fw-semibold mb-0">Products</h3>
            <a href="/products/create" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="me-1"><path d="M12 4v16m8-8H4"/></svg>
                Add Product
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="small text-uppercase text-muted">Image</th>
                        <th class="small text-uppercase text-muted">Name</th>
                        <th class="small text-uppercase text-muted">SKU</th>
                        <th class="small text-uppercase text-muted">Price</th>
                        <th class="small text-uppercase text-muted">Qty</th>
                        <th class="small text-uppercase text-muted">Value</th>
                        <th class="small text-uppercase text-muted">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $p)
                    <tr>
                        <td>
                            @if($p->image)
                                <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}" class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center rounded bg-light text-muted" style="width: 40px; height: 40px;">N/A</div>
                            @endif
                        </td>
                        <td class="fw-medium">{{ $p->name }}</td>
                        <td class="text-muted">{{ $p->sku }}</td>
                        <td>{{ number_format($p->price, 2) }}</td>
                        <td>
                            <span class="badge rounded-pill {{ $p->quantity <= 5 ? 'text-bg-danger' : 'text-bg-success' }}">
                                {{ $p->quantity }}
                            </span>
                        </td>
                        <td>{{ number_format($p->price * $p->quantity, 2) }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-1 flex-wrap">
                                <a href="/products/{{ $p->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                                <form action="/products/{{ $p->id }}/stock-in" method="POST" class="d-inline-flex align-items-center gap-1">
                                    @csrf
                                    <input type="number" name="quantity" value="1" min="1" class="form-control form-control-sm" style="width: 56px;">
                                    <button class="btn btn-sm btn-success">In</button>
                                </form>
                                <form action="/products/{{ $p->id }}/stock-out" method="POST" class="d-inline-flex align-items-center gap-1">
                                    @csrf
                                    <input type="number" name="quantity" value="1" min="1" class="form-control form-control-sm" style="width: 56px;">
                                    <button class="btn btn-sm btn-secondary">Out</button>
                                </form>
                                <form action="/products/{{ $p->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">No products found. Click "Add Product" to get started.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection