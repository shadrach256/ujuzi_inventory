@extends('layouts.auth')

@section('auth_content')
<div class="mt-2">
    <h2 class="fw-bold mb-1">Verify Your Email</h2>
    <p class="text-muted small mb-4">Enter the 4-digit OTP sent to your email address.</p>

    @if(session('success'))
        <div class="alert alert-success py-2 small" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger py-2 small" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('otp.verify.post') }}" class="mt-3">
        @csrf
        <div class="mb-3">
            <label for="otp" class="form-label">OTP Code</label>
            <input type="text" name="otp" id="otp" maxlength="4" required class="form-control text-center" style="font-size: 1.5rem; letter-spacing: 0.5rem;" placeholder="0000" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary w-100">
            Verify & Register
        </button>
    </form>
</div>
@endsection