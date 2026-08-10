@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
    <!-- KPI Cards -->
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Products</p>
                    <p class="mt-1 text-3xl font-bold text-slate-900">{{ $totalProducts }}</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Total Units</p>
                    <p class="mt-1 text-3xl font-bold text-slate-900">{{ number_format($totalUnits) }}</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/></svg>
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Inventory Value</p>
                    <p class="mt-1 text-3xl font-bold text-slate-900">{{ number_format($inventoryValue, 2) }}</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-amber-100 text-amber-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-500">Low Stock Items</p>
                    <p class="mt-1 text-3xl font-bold {{ $lowStockCount > 0 ? 'text-rose-600' : 'text-slate-900' }}">{{ $lowStockCount }}</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-rose-100 text-rose-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="mt-6 grid grid-cols-1 gap-4 lg:grid-cols-3">
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm lg:col-span-2">
            <h3 class="mb-4 text-base font-semibold text-slate-800">Stock Levels by Product</h3>
            <div class="h-72">
                <canvas id="stockChart"></canvas>
            </div>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h3 class="mb-4 text-base font-semibold text-slate-800">Inventory Value by Product</h3>
            <div class="h-72">
                <canvas id="valueChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Low Stock Alert -->
    @if($lowStockProducts->isNotEmpty())
        <div class="mt-6 rounded-xl border border-amber-200 bg-amber-50 p-5">
            <h3 class="flex items-center gap-2 text-base font-semibold text-amber-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                Low Stock Alert
            </h3>
            <div class="mt-3 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($lowStockProducts as $product)
                    <div class="flex items-center justify-between rounded-lg border border-amber-200 bg-white px-4 py-3">
                        <div>
                            <p class="text-sm font-medium text-slate-800">{{ $product->name }}</p>
                            <p class="text-xs text-slate-500">{{ $product->sku }}</p>
                        </div>
                        <span class="rounded-full bg-rose-100 px-2.5 py-1 text-xs font-semibold text-rose-700">{{ $product->quantity }} left</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Products Table -->
    <div class="mt-6 rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="flex items-center justify-between border-b border-slate-200 px-5 py-4">
            <h3 class="text-base font-semibold text-slate-800">Products</h3>
            <a href="/products/create" class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-3 py-2 text-sm font-medium text-white transition hover:bg-indigo-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Product
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-xs uppercase tracking-wider text-slate-500">
                    <tr>
                        <th class="px-5 py-3 font-semibold">Image</th>
                        <th class="px-5 py-3 font-semibold">Name</th>
                        <th class="px-5 py-3 font-semibold">SKU</th>
                        <th class="px-5 py-3 font-semibold">Price</th>
                        <th class="px-5 py-3 font-semibold">Qty</th>
                        <th class="px-5 py-3 font-semibold">Value</th>
                        <th class="px-5 py-3 font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($products as $p)
                    <tr class="hover:bg-slate-50">
                        <td class="px-5 py-3">
                            @if($p->image)
                                <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}" class="h-10 w-10 rounded-lg object-cover">
                            @else
                                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-slate-100 text-xs text-slate-400">N/A</div>
                            @endif
                        </td>
                        <td class="px-5 py-3 font-medium text-slate-800">{{ $p->name }}</td>
                        <td class="px-5 py-3 text-slate-500">{{ $p->sku }}</td>
                        <td class="px-5 py-3 text-slate-700">{{ number_format($p->price, 2) }}</td>
                        <td class="px-5 py-3">
                            <span class="rounded-full px-2.5 py-1 text-xs font-semibold {{ $p->quantity <= 5 ? 'bg-rose-100 text-rose-700' : 'bg-emerald-100 text-emerald-700' }}">
                                {{ $p->quantity }}
                            </span>
                        </td>
                        <td class="px-5 py-3 text-slate-700">{{ number_format($p->price * $p->quantity, 2) }}</td>
                        <td class="px-5 py-3">
                            <div class="flex items-center gap-2">
                                <a href="/products/{{ $p->id }}/edit" class="rounded-lg bg-amber-100 px-2.5 py-1.5 text-xs font-medium text-amber-700 transition hover:bg-amber-200">Edit</a>
                                <form action="/products/{{ $p->id }}/stock-in" method="POST" class="inline-flex items-center gap-1">
                                    @csrf
                                    <input type="number" name="quantity" value="1" min="1" class="w-14 rounded-lg border border-slate-300 px-1.5 py-1 text-xs">
                                    <button class="rounded-lg bg-emerald-100 px-2.5 py-1.5 text-xs font-medium text-emerald-700 transition hover:bg-emerald-200">In</button>
                                </form>
                                <form action="/products/{{ $p->id }}/stock-out" method="POST" class="inline-flex items-center gap-1">
                                    @csrf
                                    <input type="number" name="quantity" value="1" min="1" class="w-14 rounded-lg border border-slate-300 px-1.5 py-1 text-xs">
                                    <button class="rounded-lg bg-slate-100 px-2.5 py-1.5 text-xs font-medium text-slate-600 transition hover:bg-slate-200">Out</button>
                                </form>
                                <form action="/products/{{ $p->id }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-lg bg-rose-100 px-2.5 py-1.5 text-xs font-medium text-rose-700 transition hover:bg-rose-200">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-8 text-center text-slate-500">No products found. Click "Add Product" to get started.</td>
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