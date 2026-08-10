<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Welcome') | Ujuzi Inventory</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="auth-wrap">
        <!-- Left Brand Panel -->
        <div class="auth-brand-panel">
            <span class="auth-orb a"></span>
            <span class="auth-orb b"></span>

            <div class="d-flex align-items-center gap-2">
                <div class="brand-mark">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="M3.3 7 12 12l8.7-5"/><path d="M12 22V12"/></svg>
                </div>
                <span class="fs-5 fw-bold">Ujuzi Inventory</span>
            </div>

            <div class="py-4">
                <h1 class="display-6 fw-bold" style="letter-spacing: -0.03em;">
                    Track every item.<br>Know every value.
                </h1>
                <p class="mt-3 mb-4" style="color: rgba(226, 232, 240, 0.72); max-width: 28rem; font-size: 0.95rem;">
                    A calm, modern inventory workspace for stock levels, product value, and low-stock alerts — all in one place.
                </p>
                <ul class="list-unstyled auth-feature-list mb-0">
                    <li><span class="check"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></span>Real-time stock tracking</li>
                    <li><span class="check"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></span>Instant inventory value</li>
                    <li><span class="check"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></span>Low-stock alerts that matter</li>
                </ul>
            </div>

            <div class="auth-stats">
                <div><p class="num mb-0">100%</p><p class="lbl mb-0">Coverage</p></div>
                <div><p class="num mb-0">24/7</p><p class="lbl mb-0">Availability</p></div>
                <div><p class="num mb-0">±0s</p><p class="lbl mb-0">Sync latency</p></div>
            </div>
        </div>

        <!-- Right Form Panel -->
        <div class="auth-form-panel">
            <div class="auth-form-card card fade-up">
                <div class="mb-4 text-center d-lg-none">
                    <div class="brand-mark mx-auto mb-2" style="width: 46px; height: 46px;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="M3.3 7 12 12l8.7-5"/><path d="M12 22V12"/></svg>
                    </div>
                    <span class="fs-5 fw-bold">Ujuzi Inventory</span>
                </div>
                @yield('auth_content')
            </div>
        </div>
    </div>
</body>
</html>
