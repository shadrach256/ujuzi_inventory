<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Ujuzi Inventory System</h2>
        <form action="/logout" method="POST">@csrf <button class="btn btn-danger btn-sm">Logout</button></form>
    </div>
    
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
    
    <a href="/products/create" class="btn btn-primary mb-3">+ Add Product</a>
    
    <table class="table table-bordered bg-white shadow-sm align-middle">
        <thead class="table-dark">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>SKU</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $p)
            <tr>
                <td style="width: 100px;">
                    @if($p->image)
                        <img src="{{ asset('storage/' . $p->image) }}" alt="{{ $p->name }}" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->sku }}</td>
                <td>{{ $p->price }}</td>
                <td>{{ $p->quantity }}</td>
                <td>
                    <a href="/products/{{ $p->id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                    <form action="/products/{{ $p->id }}" method="POST" class="d-inline">@csrf @method('DELETE') <button class="btn btn-sm btn-danger">Del</button></form>
                    <form action="/products/{{ $p->id }}/stock-in" method="POST" class="d-inline">@csrf <input type="number" name="quantity" value="1" style="width:50px"><button class="btn btn-sm btn-success">In</button></form>
                    <form action="/products/{{ $p->id }}/stock-out" method="POST" class="d-inline">@csrf <input type="number" name="quantity" value="1" style="width:50px"><button class="btn btn-sm btn-secondary">Out</button></form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted p-4">No products found. Click "Add Product" to start.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>