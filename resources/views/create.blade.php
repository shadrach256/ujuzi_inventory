@extends('layouts.app')

@section('title', 'Add Product')
@section('page_title', 'Add Product')

@section('content')
    <div class="mx-auto max-w-2xl">
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 px-6 py-4">
                <h3 class="text-base font-semibold text-slate-800">New Product</h3>
                <p class="text-sm text-slate-500">Fill in the details below to add a new product to your inventory.</p>
            </div>
            <form action="/products" method="POST" enctype="multipart/form-data" class="space-y-5 p-6">
                @csrf
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                    <div>
                        <label for="name" class="mb-1 block text-sm font-medium text-slate-700">Product Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                    </div>
                    <div>
                        <label for="sku" class="mb-1 block text-sm font-medium text-slate-700">SKU</label>
                        <input type="text" name="sku" id="sku" value="{{ old('sku') }}" placeholder="e.g PROD-001" required
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                    </div>
                    <div>
                        <label for="price" class="mb-1 block text-sm font-medium text-slate-700">Price</label>
                        <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" required
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                    </div>
                    <div>
                        <label for="quantity" class="mb-1 block text-sm font-medium text-slate-700">Quantity</label>
                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" required
                            class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                    </div>
                </div>
                <div>
                    <label for="image" class="mb-1 block text-sm font-medium text-slate-700">Product Image</label>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-700 file:mr-3 file:rounded-lg file:border-0 file:bg-indigo-50 file:px-3 file:py-1.5 file:text-sm file:font-medium file:text-indigo-700 hover:file:bg-indigo-100">
                    <p class="mt-1 text-xs text-slate-400">JPG, PNG, GIF, WEBP. Max 2MB.</p>
                </div>
                <div class="flex items-center gap-3 border-t border-slate-200 pt-5">
                    <button type="submit"
                        class="rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Save Product
                    </button>
                    <a href="/dashboard" class="rounded-lg bg-slate-100 px-4 py-2.5 text-sm font-medium text-slate-600 transition hover:bg-slate-200">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection