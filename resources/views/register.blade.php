<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center vh-100">
    <div class="card mx-auto shadow p-4" style="width: 400px;">
        <h3 class="text-center mb-3">Ujuzi Shop Mall</h3>
        <h5 class="text-center text-muted mb-4">Create an Account</h5>
        
        @if(session('success')) 
            <div class="alert alert-success">{{ session('success') }}</div> 
        @endif
        
        @if($errors->any()) 
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div> 
        @endif

        <form method="POST" action="/register">
            @csrf
            <div class="mb-2">
                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
            </div>
            <div class="mb-2">
                <input type="email" name="email" class="form-control" placeholder="Email Address" required>
            </div>
            <div class="mb-2">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
            </div>
            <button class="btn btn-primary w-100 mb-2">Register</button>
            <p class="text-center mb-0"><small>Already have an account? <a href="/">Login here</a></small></p>
        </form>
    </div>
</body>
</html>