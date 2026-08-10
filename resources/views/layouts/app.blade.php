<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Ujuzi Inventory</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
</head>
<body class="bg-light">
    <div class="d-flex" style="min-height: 100vh;">
        <!-- Sidebar -->
        <aside id="sidebar" class="bg-dark text-white d-flex flex-column sidebar">
            <div class="d-flex align-items-center justify-content-between px-3 py-3 border-bottom border-secondary">
                <div class="d-flex align-items-center gap-2 sidebar-brand">
                    <div class="d-flex align-items-center justify-content-center rounded bg-primary text-white fw-bold" style="width: 32px; height: 32px;">U</div>
                    <span class="fw-bold sidebar-title">Ujuzi Inventory</span>
                </div>
                <button id="closeSidebar" class="btn btn-sm btn-outline-light d-lg-none" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/></svg>
                </button>
            </div>
            <nav class="flex-grow-1 px-2 py-3 sidebar-nav">
                @if(auth()->user()->isAdmin())
                    <a href="/admin/dashboard" class="d-flex align-items-center gap-2 rounded text-decoration-none py-2 px-2 mb-1 {{ request()->is('admin/dashboard') ? 'bg-primary text-white' : 'text-white-50 hover-bg' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="flex-shrink-0"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span class="sidebar-link">Admin Dashboard</span>
                    </a>
                @else
                    <a href="/dashboard" class="d-flex align-items-center gap-2 rounded text-decoration-none py-2 px-2 mb-1 {{ request()->is('dashboard') ? 'bg-primary text-white' : 'text-white-50 hover-bg' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="flex-shrink-0"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span class="sidebar-link">Dashboard</span>
                    </a>
                @endif
                <a href="/products/create" class="d-flex align-items-center gap-2 rounded text-decoration-none py-2 px-2 mb-1 {{ request()->is('products/create') ? 'bg-primary text-white' : 'text-white-50 hover-bg' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="flex-shrink-0"><path d="M12 4v16m8-8H4"/></svg>
                    <span class="sidebar-link">Add Product</span>
                </a>
                <a href="/products" class="d-flex align-items-center gap-2 rounded text-decoration-none py-2 px-2 mb-1 {{ request()->is('products') ? 'bg-primary text-white' : 'text-white-50 hover-bg' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" class="flex-shrink-0"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    <span class="sidebar-link">Products</span>
                </a>
            </nav>
            <div class="border-top border-secondary p-3 sidebar-footer">
                <div class="d-flex align-items-center gap-2">
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white fw-bold flex-shrink-0" style="width: 36px; height: 36px;">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="min-w-0 sidebar-user">
                        <p class="mb-0 text-truncate small fw-medium">{{ auth()->user()->name ?? 'User' }}</p>
                        <p class="mb-0 text-truncate small text-white-50">{{ auth()->user()->email ?? '' }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main -->
        <div class="flex-grow-1 d-flex flex-column min-vw-0">
            <!-- Topbar -->
            <header class="sticky-top bg-white border-bottom shadow-sm d-flex align-items-center justify-content-between px-3 px-sm-4" style="height: 64px;">
                <div class="d-flex align-items-center gap-2">
                    <button id="toggleSidebar" class="btn btn-outline-secondary btn-sm d-none d-lg-inline-flex" type="button" title="Toggle sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <button id="openSidebar" class="btn btn-outline-secondary btn-sm d-lg-none" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h1 class="h5 mb-0">@yield('page_title', 'Dashboard')</h1>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge rounded-pill text-bg-success d-none d-sm-inline-flex align-items-center gap-1">
                        <span class="rounded-circle bg-white" style="width: 8px; height: 8px; display: inline-block;"></span>
                        Online
                    </span>
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white fw-bold" style="width: 36px; height: 36px;">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <form action="/logout" method="POST" class="m-0">
                        @csrf
                        <button class="btn btn-outline-secondary btn-sm">Logout</button>
                    </form>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-grow-1 p-3 p-sm-4 p-lg-5">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-between" role="alert">
                        <span>{{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const openBtn = document.getElementById('openSidebar');
            const closeBtn = document.getElementById('closeSidebar');
            const toggleBtn = document.getElementById('toggleSidebar');

            // Mobile: show/hide sidebar
            if (openBtn) {
                openBtn.addEventListener('click', () => sidebar.classList.add('sidebar-open'));
            }
            if (closeBtn) {
                closeBtn.addEventListener('click', () => sidebar.classList.remove('sidebar-open'));
            }

            // Desktop: minimize/expand sidebar
            if (toggleBtn) {
                toggleBtn.addEventListener('click', () => {
                    document.body.classList.toggle('sidebar-minimized');
                });
            }
        });
    </script>
    @yield('scripts')
</body>
</html>