@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('page_title', 'Admin Dashboard')

@section('content')
    <!-- KPI Cards -->
    <div class="row g-3">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Products</p>
                        <p class="h3 fw-bold mb-0">{{ $totalProducts }}</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-center rounded bg-primary bg-opacity-10 text-primary" style="width: 48px; height: 48px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Total Units</p>
                        <p class="h3 fw-bold mb-0">{{ number_format($totalUnits) }}</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-center rounded bg-success bg-opacity-10 text-success" style="width: 48px; height: 48px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Inventory Value</p>
                        <p class="h3 fw-bold mb-0">{{ number_format($inventoryValue, 2) }}</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-center rounded bg-warning bg-opacity-10 text-warning" style="width: 48px; height: 48px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small mb-1">Low Stock Items</p>
                        <p class="h3 fw-bold mb-0 {{ $lowStockCount > 0 ? 'text-danger' : '' }}">{{ $lowStockCount }}</p>
                    </div>
                    <div class="d-flex align-items-center justify-content-center rounded bg-danger bg-opacity-10 text-danger" style="width: 48px; height: 48px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row g-3 mt-1">
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h3 class="h6 fw-semibold mb-3">Stock Levels by Product</h3>
                    <div style="height: 288px;">
                        <canvas id="stockChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h3 class="h6 fw-semibold mb-3">Inventory Value by Product</h3>
                    <div style="height: 288px;">
                        <canvas id="valueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Info Card -->
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-body">
            <h3 class="h6 fw-semibold d-flex align-items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" class="text-primary"><path d="M8 1a2 2 0 012 2v4H6V3a2 2 0 012-2zm3 6V3a3 3 0 00-6 0v4a2 2 0 00-2 2v5a2 2 0 002 2h6a2 2 0 002-2V9a2 2 0 00-2-2z"/></svg>
                Admin Access
            </h3>
            <p class="text-muted small mb-0">
                You have administrator access. To manage user roles, open your database interface (e.g., phpMyAdmin at
                <code>localhost/phpmyadmin</code>), find the <code>users</code> table, and change the <code>type</code>
                column from <code>user</code> to <code>admin</code> for the desired user. The change takes effect the next time they log in.
            </p>
        </div>
    </div>

    <!-- Low Stock Alert -->
    @if($lowStockProducts->isNotEmpty())
        <div class="card border-warning bg-warning-subtle mt-4">
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

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const labels = @json($products->pluck('name'));
        const quantities = @json($products->pluck('quantity'));
        const values = @json($products->map(fn ($p) => $p->price * $p->quantity));

        // Stock Levels Bar Chart
        new Chart(document.getElementById('stockChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Stock Quantity',
                    data: quantities,
                    backgroundColor: 'rgba(99, 102, 241, 0.7)',
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0 } }
                }
            }
        });

        // Inventory Value Doughnut Chart
        new Chart(document.getElementById('valueChart'), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: ['#6366f1', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#06b6d4', '#f97316', '#84cc16'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } }
                }
            }
        });
    });
</script>
@endsection
