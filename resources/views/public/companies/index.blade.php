@extends('layouts.public')

@section('meta_title', 'Companii locale – Primăria Tismana')
@section('meta_description', 'Lista companiilor locale promovate prin proiectul cu fonduri europene al Primăriei Tismana.')

@section('content')

    {{-- HEADER --}}
    <section class="hero-section py-5" style="background:linear-gradient(rgba(26,82,118,.85),rgba(26,110,158,.85)),url('https://gorjtv.ro/wp-content/uploads/2025/08/3e1292a38d9d9534ba85597d1a5d4a37bc594699.jpg') center/cover no-repeat">
        <div class="container text-center">
            <h1><i class="bi bi-buildings me-2"></i>Companii Locale</h1>
            <p class="lead mt-2">Firme din Tismana sprijinite prin proiectul nostru european</p>
        </div>
    </section>

    {{-- LISTA --}}
    <section class="py-5">
        <div class="container">
            @auth
                <div class="text-end mb-3">
                    <a href="{{ route('admin.companies.create') }}" class="btn btn-success btn-sm">
                        <i class="bi bi-plus-lg me-1"></i>Adaugă companie
                    </a>
                </div>
            @endauth
            @if($companies->count())
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
                                    <img src="{{ $company->logo_url }}" alt="{{ $company->name }}" class="mb-3" style="max-height:80px;max-width:200px;object-fit:contain">
                                @else
                                    <div class="mb-3"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1yWnzDi_pu6_4yx10RXv703BfzzwLpcqonQ&s" alt="Tismana" class="rounded" style="max-height:80px;max-width:200px;object-fit:cover"></div>
                                @endif
                                <h5 class="fw-bold mb-2">{{ $company->name }}</h5>
                                <p class="text-muted small">{{ Str::limit($company->description, 120) }}</p>

                                <div class="d-flex justify-content-center gap-3 mb-3 small text-muted">
                                    @if($company->email)
                                        <span><i class="bi bi-envelope"></i></span>
                                    @endif
                                    @if($company->phone)
                                        <span><i class="bi bi-telephone"></i></span>
                                    @endif
                                    @if($company->website)
                                        <span><i class="bi bi-globe"></i></span>
                                    @endif
                                </div>

                                <a href="{{ route('companies.show', $company) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-arrow-right me-1"></i>Vezi detalii
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox text-muted" style="font-size:4rem"></i>
                    <p class="text-muted mt-3">Nicio companie disponibilă momentan.</p>
                </div>
            @endif
        </div>
    </section>

@endsection
