@extends('layouts.auth')

@section('title', 'Login')

@section('auth_content')
    <div class="rounded-2xl bg-white p-8 shadow-xl">
        <h2 class="text-2xl font-bold text-slate-900">Welcome back</h2>
        <p class="mt-1 text-sm text-slate-500">Sign in to your account to continue.</p>

        @if(session('error'))
            <div class="mt-4 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="mt-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="/login" class="mt-6 space-y-4">
            @csrf
            <div>
                <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email Address</label>
                <input type="email" name="email" id="email" required autofocus
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
            </div>
            <div>
                <label for="password" class="mb-1 block text-sm font-medium text-slate-700">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
            </div>
            <button type="submit"
                class="w-full rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Sign In
            </button>
        </form>

        <p class="mt-6 text-center text-sm text-slate-500">
            Don't have an account?
            <a href="/register" class="font-medium text-indigo-600 hover:text-indigo-700">Create one</a>
        </p>
    </div>
@endsection