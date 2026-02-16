@extends('layouts.public')

@section('meta_title', $company->meta_title ?: $company->name . ' – Primăria Tismana')
@section('meta_description', $company->meta_description ?: Str::limit($company->description, 160))

@section('content')

    {{-- BREADCRUMB --}}
    <div class="bg-light py-3 border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Acasă</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Companii</a></li>
                    <li class="breadcrumb-item active">{{ $company->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- DETALII COMPANIE --}}
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card p-4 text-center admin-editable">
                        @auth
                            <a href="{{ route('admin.companies.edit', $company) }}" class="admin-edit-btn" style="display:inline-flex;align-items:center;gap:4px;background:#f39c12;color:#fff;border-radius:20px;padding:4px 12px;font-size:.75rem;font-weight:600;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,.15);position:absolute;top:10px;right:10px;z-index:10">
                                <i class="bi bi-pencil-fill" style="font-size:.7rem"></i> Editează compania
                            </a>
                        @endauth
                        @if($company->logo)
                            <img src="{{ $company->logo_url }}" alt="{{ $company->name }}" class="mx-auto mb-3" style="max-height:120px;max-width:250px;object-fit:contain">
                        @else
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1yWnzDi_pu6_4yx10RXv703BfzzwLpcqonQ&s" alt="Tismana" class="mx-auto mb-3 rounded" style="max-height:120px;max-width:250px;object-fit:cover">
                        @endif
                        <h4 class="fw-bold">{{ $company->name }}</h4>

                        <hr>

                        <ul class="list-unstyled text-start">
                            @if($company->address)
                            <li class="mb-2"><i class="bi bi-geo-alt text-primary me-2"></i>{{ $company->address }}</li>
                            @endif
                            @if($company->phone)
                            <li class="mb-2"><i class="bi bi-telephone text-primary me-2"></i><a href="tel:{{ $company->phone }}">{{ $company->phone }}</a></li>
                            @endif
                            @if($company->email)
                            <li class="mb-2"><i class="bi bi-envelope text-primary me-2"></i><a href="mailto:{{ $company->email }}">{{ $company->email }}</a></li>
                            @endif
                            @if($company->website)
                            <li class="mb-2"><i class="bi bi-globe text-primary me-2"></i><a href="{{ $company->website }}" target="_blank" rel="noopener">{{ $company->website }}</a></li>
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="col-lg-8">
                    <h2 class="section-title mb-3">Despre companie</h2>
                    <div class="text-muted mb-4" style="white-space:pre-line">{{ $company->description }}</div>

                    {{-- ARTICOLE COMPANIE --}}
                    @if($articles->count())
                        <h3 class="section-title mt-5 mb-3">
                            <i class="bi bi-newspaper me-2"></i>Articole ({{ $articles->total() }})
                        </h3>

                        @foreach($articles as $article)
                        <div class="card mb-3 admin-editable">
                            @auth
                                <a href="{{ route('admin.articles.edit', $article) }}" class="admin-edit-btn" style="display:inline-flex;align-items:center;gap:4px;background:#f39c12;color:#fff;border-radius:20px;padding:4px 12px;font-size:.75rem;font-weight:600;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,.15);position:absolute;top:8px;right:8px;z-index:10">
                                    <i class="bi bi-pencil-fill" style="font-size:.7rem"></i> Editează
                                </a>
                            @endauth
                            <div class="card-body d-flex gap-3">
                                @if($article->cover_image)
                                    <img src="{{ $article->cover_image_url }}" alt="{{ $article->title }}" style="width:120px;height:80px;object-fit:cover;border-radius:8px" class="flex-shrink-0">
                                @endif
                                <div>
                                    <small class="text-muted"><i class="bi bi-calendar me-1"></i>{{ $article->formatted_date }}</small>
                                    <h6 class="fw-bold mb-1">
                                        <a href="{{ route('articles.show', $article) }}" class="text-decoration-none text-dark">{{ $article->title }}</a>
                                    </h6>
                                    <p class="text-muted small mb-0">{{ Str::limit($article->excerpt, 120) }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="mt-3">{{ $articles->links() }}</div>
                    @else
                        <div class="alert alert-light mt-4">
                            <i class="bi bi-info-circle me-1"></i>Nu există articole publicate pentru această companie.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection
