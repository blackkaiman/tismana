@extends('layouts.public')

@section('meta_title', $article->meta_title ?: $article->title . ' – Primăria Tismana')
@section('meta_description', $article->meta_description ?: Str::limit($article->excerpt, 160))

@section('content')

    {{-- BREADCRUMB --}}
    <div class="bg-light py-3 border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Acasă</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Articole</a></li>
                    <li class="breadcrumb-item active">{{ Str::limit($article->title, 40) }}</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- ARTICOL --}}
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    {{-- META --}}
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <small class="text-muted"><i class="bi bi-calendar me-1"></i>{{ $article->formatted_date }}</small>
                        @if($article->company)
                            <a href="{{ route('companies.show', $article->company) }}" class="badge bg-primary text-decoration-none">
                                <i class="bi bi-building me-1"></i>{{ $article->company->name }}
                            </a>
                        @endif
                        @auth
                            <a href="{{ route('admin.articles.edit', $article) }}" class="admin-edit-btn" style="display:inline-flex;align-items:center;gap:4px;background:#f39c12;color:#fff;border-radius:20px;padding:4px 12px;font-size:.75rem;font-weight:600;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,.15)">
                                <i class="bi bi-pencil-fill" style="font-size:.7rem"></i> Editează articolul
                            </a>
                        @endauth
                    </div>

                    <h1 class="fw-bold mb-4">{{ $article->title }}</h1>

                    {{-- COVER IMAGE --}}
                    @if($article->cover_image)
                        <img src="{{ $article->cover_image_url }}" alt="{{ $article->title }}" class="img-fluid rounded shadow mb-4 w-100" style="max-height:450px;object-fit:cover">
                    @else
                        <img src="https://gorjtv.ro/wp-content/uploads/2025/08/3e1292a38d9d9534ba85597d1a5d4a37bc594699.jpg" alt="Tismana" class="img-fluid rounded shadow mb-4 w-100" style="max-height:450px;object-fit:cover">
                    @endif

                    {{-- EXCERPT --}}
                    @if($article->excerpt)
                        <p class="lead text-muted border-start border-3 border-primary ps-3 mb-4">{{ $article->excerpt }}</p>
                    @endif

                    {{-- CONTENT --}}
                    <article class="article-content">
                        {!! $article->content !!}
                    </article>

                    {{-- SHARE --}}
                    <div class="border-top mt-5 pt-4">
                        <small class="text-muted fw-bold">Distribuie:</small>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="btn btn-sm btn-outline-primary ms-2">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>
                    </div>
                </div>

                {{-- SIDEBAR --}}
                <div class="col-lg-4 mt-5 mt-lg-0">
                    @if($relatedArticles->count())
                        <div class="card">
                            <div class="card-header bg-primary text-white fw-bold">
                                <i class="bi bi-newspaper me-1"></i>Articole similare
                            </div>
                            <div class="list-group list-group-flush">
                                @foreach($relatedArticles as $related)
                                <a href="{{ route('articles.show', $related) }}" class="list-group-item list-group-item-action">
                                    <small class="text-muted d-block">{{ $related->formatted_date }}</small>
                                    <span class="fw-semibold">{{ Str::limit($related->title, 50) }}</span>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($article->company)
                    <div class="card mt-4">
                        <div class="card-body text-center">
                            @if($article->company->logo)
                                <img src="{{ $article->company->logo_url }}" alt="{{ $article->company->name }}" style="max-height:60px" class="mb-2">
                            @endif
                            <h6 class="fw-bold">{{ $article->company->name }}</h6>
                            <a href="{{ route('companies.show', $article->company) }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-building me-1"></i>Vizitează profil
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
