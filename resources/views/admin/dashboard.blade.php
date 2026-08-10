@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('page_title', 'Admin Dashboard')

@section('content')
    <!-- Page Hero -->
    <section class="page-hero fade-up mb-4">
        <div class="d-flex flex-column flex-xl-row align-items-start justify-content-between gap-3">
            <div>
                <span class="hero-greeting">Admin · Overview</span>
                <h2>Admin Dashboard</h2>
                <p>Current inventory KPIs and stock alerts.</p>
            </div>
            <div class="hero-actions flex-shrink-0">
                <a href="/products/create" class="hero-chip solid">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    Add Product
                </a>
                <a href="/products" class="hero-chip">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="M3.3 7 12 12l8.7-5"/><path d="M12 22V12"/></svg>
                    View Products
                </a>
            </div>
        </div>
    </section>

    <!-- KPI Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3 fade-up d1">
            <div class="card card-hover stat-card h-100" style="--stat-grad: linear-gradient(135deg,#0f766e,#14b8a6); --stat-glow: rgba(16,185,129,0.28);">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="stat-label mb-1">Total Products</p>
                        <p class="stat-value mb-1">{{ $stats['totalProducts'] }}</p>
                        <span class="stat-sub trend-up">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 7-7 7 7"/><path d="M12 19V5"/></svg>
                            Catalogue
                        </span>
                    </div>
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="M3.3 7 12 12l8.7-5"/><path d="M12 22V12"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3 fade-up d2">
            <div class="card card-hover stat-card h-100" style="--stat-grad: linear-gradient(135deg,#4f46e5,#6366f1); --stat-glow: rgba(99,102,241,0.3);">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="stat-label mb-1">Total Units</p>
                        <p class="stat-value mb-1">{{ number_format($stats['totalUnits']) }}</p>
                        <span class="stat-sub trend-neutral">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/></svg>
                            In storage
                        </span>
                    </div>
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6.3 2.5A1.5 1.5 0 0 1 7.7 2h8.6a1.5 1.5 0 0 1 1.4.5l4 5A1.5 1.5 0 0 1 22 8.5v11a1.5 1.5 0 0 1-1.5 1.5h-17A1.5 1.5 0 0 1 2 19.5v-11a1.5 1.5 0 0 1 .4-1l4-5Z"/><path d="M2 8h20"/><path d="M14 2v4"/><path d="m10 12 2 2 4-4"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3 fade-up d3">
            <div class="card card-hover stat-card h-100" style="--stat-grad: linear-gradient(135deg,#f59e0b,#f97316); --stat-glow: rgba(245,158,11,0.3);">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="stat-label mb-1">Inventory Value</p>
                        <p class="stat-value mb-1">{{ number_format($stats['inventoryValue'], 0) }}</p>
                        <span class="stat-sub trend-warn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                            Shs
                        </span>
                    </div>
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 9a2 2 0 0 1 2-2h.93a2 2 0 0 0 1.664-.855l.812-1.217A2 2 0 0 1 9.07 4h5.86a2 2 0 0 1 1.664.928l.812 1.217A2 2 0 0 0 19.07 7H22"/><path d="M22 9v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2Z"/><path d="M8 13h.01"/><path d="M16 13h.01"/></svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3 fade-up d4">
            <div class="card card-hover stat-card h-100" style="--stat-grad: {{ $stats['lowStockCount'] > 0 ? 'linear-gradient(135deg,#e11d48,#f43f5e)' : 'linear-gradient(135deg,#059669,#10b981)' }}; --stat-glow: {{ $stats['lowStockCount'] > 0 ? 'rgba(225,29,72,0.3)' : 'rgba(16,185,129,0.3)' }};">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="stat-label mb-1">Low Stock Items</p>
                        <p class="stat-value mb-1 {{ $stats['lowStockCount'] > 0 ? 'text-danger' : '' }}">{{ $stats['lowStockCount'] }}</p>
                        <span class="stat-sub {{ $stats['lowStockCount'] > 0 ? 'trend-danger' : 'trend-up' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 9v4"/><path d="M12 17h.01"/><path d="M10.3 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.7 3.86a2 2 0 0 0-3.4 0z"/></svg>
                            Needs attention
                        </span>
                    </div>
                    <div class="stat-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 9v4"/><path d="M12 17h.01"/><path d="M10.3 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.7 3.86a2 2 0 0 0-3.4 0z"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-8 fade-up">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="h6 fw-semibold mb-0">Stock Levels by Product</h3>
                    <span class="badge-soft neutral"><span class="dot"></span>Quantities</span>
                </div>
                <div class="card-body">
                    <div style="height: 300px;"><canvas id="stockChart"></canvas></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 fade-up d1">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="h6 fw-semibold mb-0">Inventory Value by Product</h3>
                    <span class="badge-soft warning"><span class="dot"></span>Shs</span>
                </div>
                <div class="card-body">
                    <div style="height: 300px;"><canvas id="valueChart"></canvas></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Actions -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-6 fade-up d1">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="h6 fw-semibold mb-0">Admin Controls</h3>
                    <span class="badge-soft neutral"><span class="dot"></span>Manage</span>
                </div>
                <div class="card-body">
                    <p class="small text-muted mb-3">Use this page to monitor inventory health and low stock alerts.</p>
                    <a href="/products" class="btn btn-primary btn-sm">Go to Product List</a>
                    <a href="/products/create" class="btn btn-soft btn-sm">Add New Product</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 fade-up d2">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h3 class="h6 fw-semibold mb-0">Inventory Snapshot</h3>
                    <span class="badge-soft warning"><span class="dot"></span>Admin</span>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="small text-muted">Total products</span>
                            <span class="fw-semibold">{{ $stats['totalProducts'] }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="small text-muted">Total units</span>
                            <span class="fw-semibold">{{ number_format($stats['totalUnits']) }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="small text-muted">Low stock items</span>
                            <span class="fw-semibold">{{ $stats['lowStockCount'] }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="small text-muted">Inventory value</span>
                            <span class="fw-semibold">{{ number_format($stats['inventoryValue'], 0) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Alert -->
    @if($lowStockProducts->isNotEmpty())
        <div class="card border-0 shadow-sm mb-4 fade-up d3" style="border-left: 4px solid var(--amber) !important;">
            <div class="card-header d-flex align-items-center justify-content-between py-3 flex-wrap gap-2">
                <h3 class="h6 fw-semibold mb-0 d-flex align-items-center gap-2">
                    <span class="badge-soft warning"><span class="dot"></span>Low Stock</span>
                    <span class="text-muted fw-normal small">{{ $lowStockProducts->count() }} item(s) below threshold</span>
                </h3>
                <a href="/products" class="btn btn-soft btn-sm">Review stock</a>
            </div>
            <div class="card-body">
                <div class="row g-2">
                    @foreach($lowStockProducts as $product)
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="d-flex align-items-center justify-content-between border rounded-3 px-3 py-2" style="border-color: rgba(245,158,11,0.25) !important; background: rgba(255,251,235,0.6);">
                                <div class="d-flex align-items-center gap-2 min-w-0">
                                    <div class="product-thumb" style="background: {{ $product->image ? 'transparent' : '#f59e0b' }};">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width:44px;height:44px;object-fit:cover;">
                                        @else
                                            {{ strtoupper(substr($product->name, 0, 2)) }}
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="small fw-bold mb-0 text-truncate">{{ $product->name }}</p>
                                        <p class="small text-muted mb-0">{{ $product->sku }}</p>
                                    </div>
                                </div>
                                <span class="badge-soft danger">{{ $product->quantity }} left</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

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
                    backgroundColor: 'rgba(16, 185, 129, 0.75)',
                    hoverBackgroundColor: 'rgba(15, 118, 110, 0.9)',
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0, color: '#94a3b8' }, grid: { color: 'rgba(15, 23, 42, 0.06)' } },
                    x: { ticks: { color: '#94a3b8' }, grid: { display: false } }
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
                    backgroundColor: ['#10b981', '#6366f1', '#f59e0b', '#e11d48', '#8b5cf6', '#06b6d4', '#f97316', '#84cc16'],
                    borderWidth: 0,
                    hoverOffset: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: { position: 'bottom', labels: { boxWidth: 10, boxHeight: 10, usePointStyle: true, pointStyle: 'circle', font: { size: 11, weight: 600 }, color: '#5b6b7f' } }
                }
            }
        });
    });
</script>
@endsection
