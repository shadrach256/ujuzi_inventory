@extends('layouts.auth')

@section('title', 'Login')

@section('auth_content')
    <h2 class="fw-bold mb-1">Welcome back</h2>
    <p class="text-muted small mb-4">Sign in to your account to continue.</p>

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

    <form method="POST" action="/login" class="mt-2">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <div class="input-icon-group">
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                <input type="email" name="email" id="email" required autofocus class="form-control" placeholder="you@example.com">
            </div>
        </div>
        <div class="mb-4">
            <label for="password" class="form-label">Password</label>
            <div class="input-icon-group">
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                <input type="password" name="password" id="password" required class="form-control" placeholder="••••••••">
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><path d="m10 17 5-5-5-5"/><path d="M15 12H3"/></svg>
            Sign In
        </button>
    </form>

    <p class="mt-4 text-center small text-muted mb-0">
        Don't have an account?
        <a href="/register" class="fw-bold text-decoration-none" style="color: var(--primary);">Create one</a>
    </p>
@endsection