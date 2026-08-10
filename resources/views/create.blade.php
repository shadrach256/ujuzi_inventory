<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card p-4 mx-auto shadow" style="max-width:500px;">
        <h3>Add Product</h3>
        <!-- WE ADDED enctype="multipart/form-data" BELOW -->
        <form action="/products" method="POST" enctype="multipart/form-data">@csrf
            <div class="mb-2">
                <input type="text" name="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="mb-2">
                <input type="text" name="sku" class="form-control" placeholder="SKU (e.g PROD-001)" required>
            </div>
            <div class="mb-2">
                <input type="number" step="0.01" name="price" class="form-control" placeholder="Price" required>
            </div>
            <div class="mb-2">
                <input type="number" name="quantity" class="form-control" placeholder="Quantity" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Product Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <button class="btn btn-primary">Save</button>
            <a href="/dashboard" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
</body>
</html>