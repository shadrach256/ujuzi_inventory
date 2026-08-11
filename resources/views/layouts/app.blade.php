<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Ujuzi Inventory</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
</head>
<body>
    <div class="app-shell d-flex">
        <!-- Backdrop (mobile) -->
        <div id="sidebarBackdrop" class="sidebar-backdrop"></div>

        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar">
            <div class="sidebar-inner">
                <div class="sidebar-brand d-flex align-items-center justify-content-between">
                    <a href="{{ auth()->check() && auth()->user()->isAdmin() ? '/admin/dashboard' : '/dashboard' }}" class="d-flex align-items-center gap-2 text-decoration-none me-auto">
                        <div class="brand-mark">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="M3.3 7 12 12l8.7-5"/><path d="M12 22V12"/></svg>
                        </div>
                        <div class="brand-word sidebar-title">
                            <strong>Ujuzi</strong>
                            <small>Inventory</small>
                        </div>
                    </a>
                    <button id="closeSidebar" class="btn btn-sm btn-outline-light d-lg-none" type="button" aria-label="Close menu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                    </button>
                </div>

                <nav class="sidebar-nav">
                    <span class="sidebar-section-label">Menu</span>

                    @if(auth()->check() && auth()->user()->isAdmin())
                        <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                            <span class="sidebar-link">Dashboard</span>
                        </a>
                    @else
                        <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                            <span class="sidebar-link">Dashboard</span>
                        </a>
                    @endif

                    <a href="/products" class="{{ request()->is('products') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="M3.3 7 12 12l8.7-5"/><path d="M12 22V12"/></svg>
                        <span class="sidebar-link">Products</span>
                        <span class="nav-count sidebar-link">{{ $navProductCount ?? \App\Models\Product::count() }}</span>
                    </a>

                    <a href="/products/create" class="{{ request()->is('products/create') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                        <span class="sidebar-link">Add Product</span>
                    </a>

                </nav>

                <div class="sidebar-footer">
                    <div class="sidebar-storage">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="small sidebar-link" style="color: rgba(226, 232, 240, 0.75); font-weight: 600;">Capacity</span>
                            <span class="small sidebar-link" style="color: rgba(148, 163, 184, 0.8); font-weight: 600;">{{ $navProductCount ?? \App\Models\Product::count() }}/100</span>
                        </div>
                        <div class="prog sidebar-link"><span style="width: {{ min(100, ($navProductCount ?? \App\Models\Product::count()) * 8) }}%;"></span></div>
                    </div>

                    <div class="profile-chip">
                        <div class="avatar avatar-lg">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                            <span class="online-dot"></span>
                        </div>
                        <div class="min-w-0 sidebar-user">
                            <p class="mb-0 text-truncate small fw-bold sidebar-link" style="color: #fff;">{{ auth()->user()->name ?? 'User' }}</p>
                            <p class="mb-0 text-truncate small sidebar-link" style="color: rgba(148, 163, 184, 0.8);">{{ auth()->user()->email ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main -->
        <div class="main-wrap">
            <!-- Topbar -->
            <header class="topbar">
                <div class="d-flex align-items-center gap-2 gap-sm-3">
                    <button id="toggleSidebar" class="icon-btn d-none d-lg-inline-flex" type="button" title="Toggle sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
                    </button>
                    <button id="openSidebar" class="icon-btn d-lg-none" type="button" aria-label="Open menu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                    </button>
                    <div class="topbar-title">
                        <h1>@yield('page_title', 'Dashboard')</h1>
                        <p class="d-none d-sm-block">Welcome back, {{ ucfirst(strtok(auth()->user()->name ?? 'User', ' ')) }}</p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2 gap-sm-3">
                    <form action="/products" method="GET" class="topbar-search d-none d-md-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        <input id="globalSearch" type="text" name="search" value="{{ request('search') }}" placeholder="Search products, SKUs..." autocomplete="off">
                        <kbd>/</kbd>
                    </form>

                    <span class="online-pill d-none d-sm-inline-flex">
                        <span class="dot"></span>
                        Online
                    </span>

                    <!-- Notifications -->
                    <div class="dropdown">
                        <button class="icon-btn dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside" type="button" aria-label="Notifications">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                            <span class="ping-dot"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" style="width: 320px;">
                            <h6 class="dropdown-header">Notifications</h6>
                            @forelse(($lowStockProducts ?? collect())->take(3) as $p)
                                <div class="notif-item">
                                    <div class="notif-icon" style="background: rgba(225, 29, 72, 0.09); color: #e11d48;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 9v4"/><path d="M12 17h.01"/><path d="M10.3 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.7 3.86a2 2 0 0 0-3.4 0z"/></svg>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="mb-0 text-truncate small fw-semibold">{{ $p->name }} is low on stock</p>
                                        <small>{{ $p->quantity }} unit(s) remaining · {{ $p->sku }}</small>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-muted small py-3 mb-0">No notifications</p>
                            @endforelse
                            <div class="dropdown-divider my-2"></div>
                            <a href="/dashboard" class="dropdown-item justify-content-center small">View all</a>
                        </div>
                    </div>

                    <!-- Profile dropdown -->
                    <div class="dropdown">
                        <button class="btn p-0 border-0 bg-transparent dropdown-toggle" data-bs-toggle="dropdown" type="button" aria-label="Account menu">
                            <div class="avatar avatar-md">
                                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                <span class="online-dot"></span>
                            </div>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" style="min-width: 220px;">
                            <div class="px-3 py-2">
                                <p class="mb-0 fw-bold text-truncate">{{ auth()->user()->name ?? 'User' }}</p>
                                <p class="mb-0 small text-muted text-truncate">{{ auth()->user()->email ?? '' }}</p>
                            </div>
                            <div class="dropdown-divider my-1"></div>
                            <h6 class="dropdown-header">Session</h6>
                            <form action="/logout" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item w-100 text-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="m16 17 5-5-5-5"/><path d="M21 12H9"/></svg>
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="main-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center justify-content-between" role="alert">
                        <span class="d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                            {{ session('success') }}
                        </span>
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
            const backdrop = document.getElementById('sidebarBackdrop');
            const openBtn = document.getElementById('openSidebar');
            const closeBtn = document.getElementById('closeSidebar');
            const toggleBtn = document.getElementById('toggleSidebar');
            const searchInput = document.getElementById('globalSearch');

            // Mobile: show/hide sidebar
            function openMobile() {
                sidebar.classList.add('sidebar-open');
                backdrop.classList.add('show');
            }
            function closeMobile() {
                sidebar.classList.remove('sidebar-open');
                backdrop.classList.remove('show');
            }

            if (openBtn) openBtn.addEventListener('click', openMobile);
            if (closeBtn) closeBtn.addEventListener('click', closeMobile);
            if (backdrop) backdrop.addEventListener('click', closeMobile);

            // Desktop: minimize/expand sidebar
            if (toggleBtn) {
                toggleBtn.addEventListener('click', () => document.body.classList.toggle('sidebar-minimized'));
            }

            // Global search — live filter
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    const q = this.value.toLowerCase();
                    const rows = document.querySelectorAll('[data-product-row]');
                    rows.forEach(row => {
                        const hay = (row.dataset.search || '').toLowerCase();
                        row.style.display = hay.includes(q) ? '' : 'none';
                    });
                    const emptyFilter = document.getElementById('filterEmpty');
                    if (emptyFilter) {
                        const visible = [...rows].filter(r => r.style.display !== 'none').length;
                        emptyFilter.style.display = visible === 0 ? '' : 'none';
                    }
                });

                document.addEventListener('keydown', function (e) {
                    if (e.key === '/' && !['INPUT', 'TEXTAREA'].includes(document.activeElement.tagName)) {
                        e.preventDefault();
                        searchInput.focus();
                    }
                    if (e.key === 'Escape') searchInput.blur();
                });
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
