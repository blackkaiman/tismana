@extends('layouts.public')

@section('meta_title', $settings['hero_title'] ?? 'Primăria Orașului Tismana')
@section('meta_description', 'Platformă dedicată companiilor locale din Tismana – proiect finanțat din fonduri europene.')

@section('content')

    {{-- ═══ HERO ═══ --}}
    <section class="hero-section text-center" style="background:linear-gradient(rgba(26,82,118,.85),rgba(26,110,158,.85)),url('https://gorjtv.ro/wp-content/uploads/2025/08/3e1292a38d9d9534ba85597d1a5d4a37bc594699.jpg') center/cover no-repeat;min-height:420px;display:flex;align-items:center">
        <div class="container">
            @auth
                <div class="mb-3">
                    <a href="{{ route('admin.settings.edit') }}" class="admin-edit-btn" style="display:inline-flex;align-items:center;gap:4px;background:#f39c12;color:#fff;border-radius:20px;padding:4px 12px;font-size:.75rem;font-weight:600;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,.15)">
                        <i class="bi bi-pencil-fill" style="font-size:.7rem"></i> Editează secțiunea Hero
                    </a>
                </div>
            @endauth
            <h1>{{ $settings['hero_title'] ?? 'Primăria Orașului Tismana' }}</h1>
            <p class="lead mt-3 mx-auto" style="max-width:700px">
                {{ $settings['hero_subtitle'] ?? 'Platformă dedicată promovării companiilor locale – proiect co-finanțat din fonduri europene.' }}
            </p>
            <div class="mt-4">
                <a href="{{ route('companies.index') }}" class="btn btn-light btn-lg me-2">
                    <i class="bi bi-buildings me-1"></i>Vezi companiile
                </a>
                <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                    <i class="bi bi-envelope me-1"></i>Contact
                </a>
            </div>
        </div>
    </section>

    {{-- ═══ DESPRE PROIECT ═══ --}}
    @if(!empty($settings['about_title']))
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="section-title">{{ $settings['about_title'] }}</h2>
                    <div class="text-muted">{!! nl2br(e($settings['about_content'] ?? '')) !!}</div>
                </div>
                <div class="col-lg-6 text-center">
                    @if(!empty($settings['hero_image']))
                        <img src="{{ Storage::url($settings['hero_image']) }}" alt="Proiect Tismana" class="img-fluid rounded shadow">
                    @else
                        <img src="{{ asset('images/tismana-main.png') }}" alt="Orașul Tismana" class="img-fluid rounded shadow" style="max-height:350px;object-fit:cover;width:100%">
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    {{-- ═══ STATISTICI ═══ --}}
    <section class="bg-section py-5">
        <div class="container">
            @auth
                <div class="text-end mb-3">
                    <a href="{{ route('admin.settings.edit') }}" class="admin-edit-btn" style="display:inline-flex;align-items:center;gap:4px;background:#f39c12;color:#fff;border-radius:20px;padding:4px 12px;font-size:.75rem;font-weight:600;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,.15)">
                        <i class="bi bi-pencil-fill" style="font-size:.7rem"></i> Editează statisticile
                    </a>
                </div>
            @endauth
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <div class="card p-4 h-100">
                        <i class="bi bi-buildings text-primary" style="font-size:2.5rem"></i>
                        <h3 class="mt-3 fw-bold text-primary">{{ $settings['stat_companies'] ?? '21' }}</h3>
                        <p class="text-muted mb-0">Companii Înregistrate</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 h-100">
                        <i class="bi bi-people text-success" style="font-size:2.5rem"></i>
                        <h3 class="mt-3 fw-bold text-success">{{ $settings['stat_jobs'] ?? '150+' }}</h3>
                        <p class="text-muted mb-0">Locuri de Muncă Create</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 h-100">
                        <i class="bi bi-currency-euro text-warning" style="font-size:2.5rem"></i>
                        <h3 class="mt-3 fw-bold text-warning">{{ $settings['stat_funding'] ?? '€2M+' }}</h3>
                        <p class="text-muted mb-0">Fonduri Europene Atrase</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ COMPANII PROMOVATE ═══ --}}
    @if($companies->count())
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="section-title">Companii Promovate</h2>
                <p class="section-subtitle">Firme locale sprijinite prin proiectul nostru</p>
            </div>
            <div class="row g-4">
                @foreach($companies as $company)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 admin-editable">
                        @auth
                            <a href="{{ route('admin.companies.edit', $company) }}" class="admin-edit-btn" style="display:inline-flex;align-items:center;gap:4px;background:#f39c12;color:#fff;border-radius:20px;padding:4px 12px;font-size:.75rem;font-weight:600;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,.15);position:absolute;top:10px;right:10px;z-index:10">
                                <i class="bi bi-pencil-fill" style="font-size:.7rem"></i> Editează
                            </a>
                        @endauth
                        <div class="card-body text-center p-4">
                            @if($company->logo)
                                <img src="{{ $company->logo_url }}" alt="{{ $company->name }}" class="mb-3" style="max-height:70px;max-width:180px;object-fit:contain">
                            @else
                                <div class="mb-3"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1yWnzDi_pu6_4yx10RXv703BfzzwLpcqonQ&s" alt="Tismana" class="rounded" style="max-height:70px;max-width:180px;object-fit:cover"></div>
                            @endif
                            <h5 class="fw-bold">{{ $company->name }}</h5>
                            <p class="text-muted small">{{ Str::limit($company->description, 100) }}</p>
                            <a href="{{ route('companies.show', $company) }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-arrow-right me-1"></i>Detalii
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('companies.index') }}" class="btn btn-primary">
                    <i class="bi bi-grid me-1"></i>Toate companiile
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- ═══ ULTIMELE ARTICOLE ═══ --}}
    @if($articles->count())
    <section class="bg-section py-5">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="section-title">Ultimele Articole</h2>
                <p class="section-subtitle">Noutăți și actualizări din proiect</p>
            </div>
            <div class="row g-4">
                @foreach($articles as $article)
                <div class="col-md-6 col-lg-3">
                    <div class="card h-100 admin-editable">
                        @auth
                            <a href="{{ route('admin.articles.edit', $article) }}" class="admin-edit-btn" style="display:inline-flex;align-items:center;gap:4px;background:#f39c12;color:#fff;border-radius:20px;padding:4px 12px;font-size:.75rem;font-weight:600;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,.15);position:absolute;top:10px;right:10px;z-index:10">
                                <i class="bi bi-pencil-fill" style="font-size:.7rem"></i> Editează
                            </a>
                        @endauth
                        @if($article->cover_image)
                            <img src="{{ $article->cover_image_url }}" class="card-img-top" alt="{{ $article->title }}" style="height:180px;object-fit:cover">
                        @else
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1yWnzDi_pu6_4yx10RXv703BfzzwLpcqonQ&s" class="card-img-top" alt="Tismana" style="height:180px;object-fit:cover">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <small class="text-muted mb-1">
                                <i class="bi bi-calendar me-1"></i>{{ $article->formatted_date }}
                            </small>
                            <h6 class="fw-bold">{{ Str::limit($article->title, 60) }}</h6>
                            <p class="text-muted small flex-grow-1">{{ Str::limit($article->excerpt, 80) }}</p>
                            <a href="{{ route('articles.show', $article) }}" class="btn btn-sm btn-outline-primary mt-auto">
                                Citește <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('articles.index') }}" class="btn btn-primary">
                    <i class="bi bi-newspaper me-1"></i>Toate articolele
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- ═══ CTA CONTACT ═══ --}}
    <section class="py-5 text-center" style="background:linear-gradient(135deg,var(--primary),#2ecc71);color:#fff">
        <div class="container">
            <h2 class="fw-bold mb-3">Ai întrebări despre proiect?</h2>
            <p class="lead mb-4">Contactează-ne pentru informații suplimentare</p>
            <a href="{{ route('contact') }}" class="btn btn-light btn-lg">
                <i class="bi bi-envelope me-2"></i>Trimite un mesaj
            </a>
        </div>
    </section>

@endsection
