<!DOCTYPE html><html><head><title>Add</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light"><div class="container mt-5">
    <div class="card p-4 mx-auto shadow" style="max-width:500px;">
        <h3>Add Product</h3>
        <form action="/products" method="POST">@csrf
            <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
            <input type="text" name="sku" class="form-control mb-2" placeholder="SKU" required>
            <input type="number" step="0.01" name="price" class="form-control mb-2" placeholder="Price" required>
            <input type="number" name="quantity" class="form-control mb-3" placeholder="Quantity" required>
            <button class="btn btn-primary">Save</button>
            <a href="/dashboard" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div></body></html>