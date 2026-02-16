<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') – Primăria Tismana</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
            --primary: #1a5276;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; }

        /* ── SIDEBAR ── */
        .admin-sidebar {
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: var(--sidebar-width);
            background: var(--primary);
            color: #fff;
            overflow-y: auto;
            z-index: 1040;
            transition: transform .3s;
        }
        .admin-sidebar .brand {
            padding: 20px;
            font-size: 1.15rem;
            font-weight: 700;
            border-bottom: 1px solid rgba(255,255,255,.1);
        }
        .admin-sidebar .nav-link {
            color: rgba(255,255,255,.7);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: .93rem;
            transition: all .2s;
            border-left: 3px solid transparent;
        }
        .admin-sidebar .nav-link:hover {
            background: rgba(255,255,255,.08);
            color: #fff;
        }
        .admin-sidebar .nav-link.active {
            background: rgba(255,255,255,.12);
            color: #fff;
            border-left-color: #2ecc71;
        }
        .admin-sidebar .nav-section {
            padding: 15px 20px 5px;
            font-size: .75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,.4);
        }

        /* ── TOPBAR ── */
        .admin-topbar {
            margin-left: var(--sidebar-width);
            height: 60px;
            background: #fff;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 25px;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        /* ── MAIN ── */
        .admin-main {
            margin-left: var(--sidebar-width);
            padding: 25px;
            min-height: calc(100vh - 60px);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 991.98px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.show { transform: translateX(0); }
            .admin-topbar, .admin-main { margin-left: 0; }
        }

        /* ── CARDS ── */
        .stat-card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,.06); }
        .stat-card .icon { width: 50px; height: 50px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }

        @yield('extra_css')
    </style>
</head>
<body>

    {{-- ─── SIDEBAR ─── --}}
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="brand">
            <i class="bi bi-building me-2"></i>Admin Tismana
        </div>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <div class="nav-section">Conținut</div>

            <a href="{{ route('admin.companies.index') }}" class="nav-link {{ request()->routeIs('admin.companies.*') ? 'active' : '' }}">
                <i class="bi bi-buildings"></i> Companii
            </a>
            <a href="{{ route('admin.articles.index') }}" class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                <i class="bi bi-newspaper"></i> Articole
            </a>
            <a href="{{ route('admin.pages.index') }}" class="nav-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i> Pagini
            </a>

            <div class="nav-section">Sistem</div>

            <a href="{{ route('admin.settings.edit') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i> Setări
            </a>
            <a href="{{ route('admin.messages.index') }}" class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                <i class="bi bi-chat-dots"></i> Mesaje
                @php $unreadCount = \App\Models\ContactMessage::unread()->count(); @endphp
                @if($unreadCount > 0)
                    <span class="badge bg-danger ms-auto">{{ $unreadCount }}</span>
                @endif
            </a>

            <div class="nav-section">Cont</div>

            <a href="{{ route('home') }}" class="nav-link" target="_blank">
                <i class="bi bi-box-arrow-up-right"></i> Vezi site-ul
            </a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="nav-link w-100 border-0 bg-transparent text-start">
                    <i class="bi bi-box-arrow-left"></i> Deconectare
                </button>
            </form>
        </nav>
    </aside>

    {{-- ─── TOPBAR ─── --}}
    <header class="admin-topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-sm btn-outline-secondary d-lg-none" onclick="document.getElementById('adminSidebar').classList.toggle('show')">
                <i class="bi bi-list"></i>
            </button>
            <h5 class="mb-0 fw-bold">@yield('title', 'Dashboard')</h5>
        </div>
        <div class="text-muted small">
            <i class="bi bi-person-circle me-1"></i>{{ Auth::user()->name }}
        </div>
    </header>

    {{-- ─── MAIN ─── --}}
    <div class="admin-main">
        {{-- Flash messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-1"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
