<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center vh-100">
    <div class="card mx-auto shadow p-4" style="width: 350px;">
        <h3 class="text-center mb-3">Ujuzi Shop Mall</h3>
        
        @if(session('error')) 
            <div class="alert alert-danger">{{ session('error') }}</div> 
        @endif

        @if(session('success')) 
            <div class="alert alert-success">{{ session('success') }}</div> 
        @endif

        <form method="POST" action="/login">@csrf
            <div class="mb-2">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button class="btn btn-primary w-100">Login</button>
        </form>
        
        <p class="text-center mt-3 mb-0"><small>Don't have an account? <a href="/register">Register here</a></small></p>
    </div>
</body>
</html>