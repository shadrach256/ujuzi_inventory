<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        $lowStockThreshold = 5;
        $lowStockProducts = $products->where('quantity', '<=', $lowStockThreshold);

        return view('dashboard', compact(
            'products',
            'lowStockProducts',
        ));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        Product::create($data);

        return redirect('/dashboard')->with('success', 'Product added!');
    }

    public function edit(Product $product)
    {
        return view('edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products,sku,'.$product->id,
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        $product->update($data);

        return redirect('/dashboard')->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect('/dashboard')->with('success', 'Product deleted!');
    }

    public function stockIn(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->quantity += $request->quantity;
        $product->save();

        return redirect('/dashboard')->with('success', 'Stock added!');
    }

    public function stockOut(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->quantity -= $request->quantity;
        $product->save();

        return redirect('/dashboard')->with('success', 'Stock removed!');
    }
}
