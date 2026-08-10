@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', $pageTitle ?? 'Dashboard')

@section('content')
    <!-- Page Hero -->
    <section class="page-hero fade-up mb-4">
        <div class="d-flex flex-column flex-xl-row align-items-start justify-content-between gap-3">
            <div>
                <span class="hero-greeting">Overview</span>
                <h2>Good {{ now()->format('A') === 'AM' ? 'morning' : (now()->hour < 17 ? 'afternoon' : 'evening') }}, {{ ucfirst(strtok(auth()->user()->name ?? 'User', ' ')) }}</h2>
                <p>Inventory overview and quick stock status.</p>
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

    <div class="row g-3 mb-4">
        <div class="col-12 fade-up">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h3 class="h6 fw-semibold mb-3">Inventory snapshot</h3>
                    <p class="small text-muted mb-3">A quick view of product counts, stock levels, and value.</p>
                    <div class="row g-3">
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="border rounded-3 p-3">
                                <p class="small text-muted mb-1">Products tracked</p>
                                <p class="fw-semibold mb-0">{{ $stats['totalProducts'] }}</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="border rounded-3 p-3">
                                <p class="small text-muted mb-1">Current stock</p>
                                <p class="fw-semibold mb-0">{{ number_format($stats['totalUnits']) }}</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="border rounded-3 p-3">
                                <p class="small text-muted mb-1">Inventory worth</p>
                                <p class="fw-semibold mb-0">Shs {{ number_format($stats['inventoryValue'], 0) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($lowStockProducts->isNotEmpty())
        <div class="card border-0 shadow-sm mb-4 fade-up d5" style="border-left: 4px solid var(--amber) !important;">
            <div class="card-header d-flex align-items-center justify-content-between py-3 flex-wrap gap-2">
                <h3 class="h6 fw-semibold mb-0 d-flex align-items-center gap-2">
                    <span class="badge-soft warning"><span class="dot"></span>Inventory alert</span>
                    <span class="text-muted fw-normal small">{{ $lowStockProducts->count() }} item(s) need restocking</span>
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
