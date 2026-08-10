@extends('layouts.auth')

@section('title', 'Login')

@section('auth_content')
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4 p-md-5">
            <h2 class="h4 fw-bold">Welcome back</h2>
            <p class="text-muted small">Sign in to your account to continue.</p>

            @if(session('error'))
                <div class="alert alert-danger py-2 small" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success py-2 small" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="/login" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" name="email" id="email" required autofocus class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" required class="form-control">
                </div>
                <button type="submit" class="btn btn-primary w-100">Sign In</button>
            </form>

            <p class="mt-4 text-center small text-muted mb-0">
                Don't have an account?
                <a href="/register" class="fw-medium">Create one</a>
            </p>
        </div>
    </div>
@endsection