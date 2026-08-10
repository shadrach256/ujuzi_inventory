<?php

namespace App\Http\Controllers;

use App\Models\Product;

class AdminController extends Controller
{
    public function dashboard()
    {
        $products = Product::all();

        $totalProducts = $products->count();
        $totalUnits = $products->sum('quantity');
        $inventoryValue = $products->sum(fn ($product) => $product->price * $product->quantity);
        $lowStockThreshold = 5;
        $lowStockCount = $products->where('quantity', '<=', $lowStockThreshold)->count();
        $lowStockProducts = $products->where('quantity', '<=', $lowStockThreshold);

        $stats = [
            'totalProducts' => $totalProducts,
            'totalUnits' => $totalUnits,
            'inventoryValue' => $inventoryValue,
            'lowStockCount' => $lowStockCount,
        ];

        return view('admin.dashboard', compact(
            'products',
            'totalProducts',
            'totalUnits',
            'inventoryValue',
            'lowStockCount',
            'lowStockProducts',
            'stats',
        ));
    }
}
