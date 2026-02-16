@extends('layouts.public')

@section('meta_title', 'Articole – Primăria Tismana')
@section('meta_description', 'Articole și noutăți din proiectul de promovare a companiilor locale din Tismana.')

@section('content')

    {{-- HEADER --}}
    <section class="hero-section py-5" style="background:linear-gradient(rgba(26,82,118,.85),rgba(26,110,158,.85)),url('https://gorjtv.ro/wp-content/uploads/2025/08/3e1292a38d9d9534ba85597d1a5d4a37bc594699.jpg') center/cover no-repeat">
        <div class="container text-center">
            <h1><i class="bi bi-newspaper me-2"></i>Articole</h1>
            <p class="lead mt-2">Noutăți și actualizări din proiect</p>
        </div>
    </section>

    {{-- LISTA --}}
    <section class="py-5">
        <div class="container">
            @auth
                <div class="text-end mb-3">
                    <a href="{{ route('admin.articles.create') }}" class="btn btn-success btn-sm">
                        <i class="bi bi-plus-lg me-1"></i>Adaugă articol
                    </a>
                </div>
            @endauth
            @if($articles->count())
                <div class="row g-4">
                    @foreach($articles as $article)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 admin-editable">
                            @auth
                                <a href="{{ route('admin.articles.edit', $article) }}" class="admin-edit-btn" style="display:inline-flex;align-items:center;gap:4px;background:#f39c12;color:#fff;border-radius:20px;padding:4px 12px;font-size:.75rem;font-weight:600;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,.15);position:absolute;top:10px;right:10px;z-index:10">
                                    <i class="bi bi-pencil-fill" style="font-size:.7rem"></i> Editează
                                </a>
                            @endauth
                            @if($article->cover_image)
                                <img src="{{ $article->cover_image_url }}" class="card-img-top" alt="{{ $article->title }}" style="height:200px;object-fit:cover">
                            @else
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1yWnzDi_pu6_4yx10RXv703BfzzwLpcqonQ&s" class="card-img-top" alt="Tismana" style="height:200px;object-fit:cover">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-muted">
                                        <i class="bi bi-calendar me-1"></i>{{ $article->formatted_date }}
                                    </small>
                                    @if($article->company)
                                        <span class="badge bg-primary bg-opacity-10 text-primary">{{ $article->company->name }}</span>
                                    @endif
                                </div>
                                <h5 class="fw-bold">{{ $article->title }}</h5>
                                <p class="text-muted flex-grow-1">{{ Str::limit($article->excerpt, 120) }}</p>
                                <a href="{{ route('articles.show', $article) }}" class="btn btn-outline-primary btn-sm mt-auto">
                                    Citește mai mult <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-5 d-flex justify-content-center">
                    {{ $articles->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox text-muted" style="font-size:4rem"></i>
                    <p class="text-muted mt-3">Niciun articol publicat momentan.</p>
                </div>
            @endif
        </div>
    </section>

@endsection
