<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Welcome') | Ujuzi Inventory</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <div class="d-flex" style="min-height: 100vh;">
        <!-- Left Panel (Branding) -->
        <div class="d-none d-lg-flex flex-column justify-content-between text-white p-5" style="flex: 1; background: linear-gradient(135deg, #4f46e5, #4338ca, #0f172a);">
            <div class="d-flex align-items-center gap-2">
                <div class="d-flex align-items-center justify-content-center rounded bg-white bg-opacity-25 fw-bold" style="width: 40px; height: 40px;">U</div>
                <span class="fs-5 fw-bold">Ujuzi Inventory</span>
            </div>
            <div>
                <h1 class="display-6 fw-bold">Manage your inventory<br>with confidence.</h1>
                <p class="mt-3 text-white-50" style="max-width: 28rem;">Track stock levels, manage products, and keep your business running smoothly — all in one place.</p>
            </div>
            <div class="d-flex align-items-center gap-2 small text-white-50">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                <span>Secure & reliable inventory solution</span>
            </div>
        </div>

        <!-- Right Panel (Form) -->
        <div class="d-flex align-items-center justify-content-center bg-light p-4" style="flex: 1;">
            <div style="max-width: 28rem; width: 100%;">
                <div class="mb-4 text-center d-lg-none">
                    <div class="d-inline-flex align-items-center gap-2">
                        <div class="d-flex align-items-center justify-content-center rounded bg-primary text-white fw-bold" style="width: 40px; height: 40px;">U</div>
                        <span class="fs-5 fw-bold">Ujuzi Inventory</span>
                    </div>
                </div>
                @yield('auth_content')
            </div>
        </div>
    </div>
</body>
</html>