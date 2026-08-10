@extends('layouts.auth')

@section('title', 'Register')

@section('auth_content')
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4 p-md-5">
            <h2 class="h4 fw-bold">Create an account</h2>
            <p class="text-muted small">Register to start managing your inventory.</p>

            @if(session('success'))
                <div class="alert alert-success py-2 small" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger py-2 small" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="/register" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" required class="form-control">
                    <div class="form-text">Must be at least 6 characters.</div>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="form-control">
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>

            <p class="mt-4 text-center small text-muted mb-0">
                Already have an account?
                <a href="/" class="fw-medium">Sign in</a>
            </p>
        </div>
    </div>
@endsection