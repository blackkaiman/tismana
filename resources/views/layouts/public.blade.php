<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta_title', 'Primăria Orașului Tismana – Proiect finanțat din fonduri europene')</title>
    <meta name="description" content="@yield('meta_description', 'Platformă dedicată promovării companiilor locale din Tismana, proiect co-finanțat din fonduri europene.')">

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #1a5276;
            --secondary: #2ecc71;
            --accent: #f39c12;
            --dark: #1c2833;
            --light: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        /* ── NAVBAR ── */
        .navbar-brand img {
            height: 48px;
        }
        .navbar {
            background: var(--primary) !important;
        }
        .navbar .nav-link {
            color: rgba(255,255,255,.85) !important;
            font-weight: 500;
            transition: color .2s;
        }
        .navbar .nav-link:hover,
        .navbar .nav-link.active {
            color: #fff !important;
        }

        /* ── HERO ── */
        .hero-section {
            background: linear-gradient(135deg, var(--primary) 0%, #1a6e9e 100%);
            color: #fff;
            padding: 80px 0 60px;
        }
        .hero-section h1 {
            font-size: 2.6rem;
            font-weight: 700;
        }
        .hero-section p.lead {
            font-size: 1.2rem;
            opacity: .9;
        }

        /* ── CARDS ── */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0,0,0,.06);
            transition: transform .25s, box-shadow .25s;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,.1);
        }

        /* ── SECTION TITLES ── */
        .section-title {
            font-weight: 700;
            color: var(--primary);
            margin-bottom: .5rem;
        }
        .section-subtitle {
            color: #777;
            margin-bottom: 2rem;
        }

        /* ── FOOTER ── */
        .footer {
            background: var(--dark);
            color: rgba(255,255,255,.7);
            padding: 50px 0 20px;
        }
        .footer h5 {
            color: #fff;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .footer a {
            color: rgba(255,255,255,.7);
            text-decoration: none;
            transition: color .2s;
        }
        .footer a:hover {
            color: var(--secondary);
        }
        .footer-eu {
            background: var(--primary);
            color: rgba(255,255,255,.8);
            padding: 15px 0;
            font-size: .85rem;
            text-align: center;
        }

        /* ── UTILITIES ── */
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }
        .btn-primary:hover {
            background: #154360;
            border-color: #154360;
        }
        .btn-secondary {
            background: var(--secondary);
            border-color: var(--secondary);
            color: #fff;
        }
        .btn-secondary:hover {
            background: #27ae60;
            border-color: #27ae60;
        }
        .bg-section {
            background: #f0f4f8;
        }

        /* ── ADMIN EDIT BUTTONS ── */
        .admin-edit-btn:hover {
            background: #e67e22 !important;
            transform: scale(1.05);
        }
        .admin-editable {
            position: relative;
            transition: outline .2s;
        }
        .admin-editable:hover {
            outline: 2px dashed #f39c12;
            outline-offset: 4px;
            border-radius: 6px;
        }
        .admin-editable .admin-edit-btn {
            opacity: 0;
            transition: opacity .2s;
        }
        .admin-editable:hover .admin-edit-btn {
            opacity: 1;
        }
        .admin-toolbar {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 8px;
            align-items: flex-end;
        }
        .admin-toolbar .btn {
            box-shadow: 0 3px 12px rgba(0,0,0,.25);
            border-radius: 50px;
            font-size: .85rem;
            font-weight: 600;
        }

        @yield('extra_css')
    </style>
</head>
<body>

    {{-- ─── NAVBAR ─── --}}
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <i class="bi bi-building me-2"></i>Primăria Tismana
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            <i class="bi bi-house-door me-1"></i>Acasă
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('companies.*') ? 'active' : '' }}" href="{{ route('companies.index') }}">
                            <i class="bi bi-buildings me-1"></i>Companii
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('articles.*') ? 'active' : '' }}" href="{{ route('articles.index') }}">
                            <i class="bi bi-newspaper me-1"></i>Articole
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                            <i class="bi bi-envelope me-1"></i>Contact
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- ─── FLASH MESSAGES ─── --}}
    @if(session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    {{-- ─── MAIN ─── --}}
    <main>
        @yield('content')
    </main>

    {{-- ─── ADMIN FLOATING TOOLBAR ─── --}}
    @auth
    <div class="admin-toolbar">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-dark">
            <i class="bi bi-speedometer2 me-1"></i>Admin Panel
        </a>
        <a href="{{ route('admin.companies.index') }}" class="btn btn-primary">
            <i class="bi bi-buildings me-1"></i>Companii
        </a>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-success">
            <i class="bi bi-plus-lg me-1"></i>Articol nou
        </a>
        <a href="{{ route('admin.settings.edit') }}" class="btn btn-warning text-white">
            <i class="bi bi-gear me-1"></i>Setări
        </a>
    </div>
    @endauth

    {{-- ─── FOOTER ─── --}}
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5><i class="bi bi-building me-2"></i>Primăria Tismana</h5>
                    <p>{{ \App\Models\Setting::get('footer_text', 'Platformă dedicată promovării companiilor locale din Tismana.') }}</p>
                </div>
                <div class="col-lg-4">
                    <h5>Navigare</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}"><i class="bi bi-chevron-right me-1"></i>Acasă</a></li>
                        <li class="mb-2"><a href="{{ route('companies.index') }}"><i class="bi bi-chevron-right me-1"></i>Companii</a></li>
                        <li class="mb-2"><a href="{{ route('articles.index') }}"><i class="bi bi-chevron-right me-1"></i>Articole</a></li>
                        <li class="mb-2"><a href="{{ route('contact') }}"><i class="bi bi-chevron-right me-1"></i>Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5>Contact</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-geo-alt me-2"></i>{{ \App\Models\Setting::get('contact_address', 'Tismana, Gorj') }}</li>
                        <li class="mb-2"><i class="bi bi-telephone me-2"></i>{{ \App\Models\Setting::get('contact_phone', '0253 000 000') }}</li>
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i>{{ \App\Models\Setting::get('contact_email', 'contact@tismana.ro') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <div class="footer-eu">
        <div class="container">
            Proiect co-finanțat din Fondul Social European prin Programul Operațional Capital Uman 2014-2020
        </div>
    </div>

    {{-- Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
