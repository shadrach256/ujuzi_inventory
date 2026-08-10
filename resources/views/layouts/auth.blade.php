<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Welcome') | Ujuzi Inventory</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen items-center justify-center bg-slate-950 font-sans text-slate-800 antialiased">
    <div class="relative flex w-full min-h-screen">
        <!-- Left Panel (Branding) -->
        <div class="hidden lg:flex lg:w-1/2 flex-col justify-between bg-gradient-to-br from-indigo-600 via-indigo-700 to-slate-900 p-12 text-white">
            <div class="flex items-center gap-2">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/20 text-lg font-bold backdrop-blur">U</div>
                <span class="text-xl font-bold tracking-tight">Ujuzi Inventory</span>
            </div>
            <div>
                <h1 class="text-4xl font-bold leading-tight">Manage your inventory<br>with confidence.</h1>
                <p class="mt-4 max-w-md text-indigo-200">Track stock levels, manage products, and keep your business running smoothly — all in one place.</p>
            </div>
            <div class="flex items-center gap-2 text-sm text-indigo-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                <span>Secure & reliable inventory solution</span>
            </div>
        </div>

        <!-- Right Panel (Form) -->
        <div class="flex w-full items-center justify-center bg-slate-100 p-6 lg:w-1/2">
            <div class="w-full max-w-md">
                <div class="mb-8 lg:hidden text-center">
                    <div class="inline-flex items-center gap-2">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-lg font-bold text-white">U</div>
                        <span class="text-xl font-bold text-slate-900">Ujuzi Inventory</span>
                    </div>
                </div>
                @yield('auth_content')
            </div>
        </div>
    </div>
</body>
</html>