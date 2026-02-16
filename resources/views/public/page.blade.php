@extends('layouts.public')

@section('meta_title', $page->meta_title ?: $page->title . ' – Primăria Tismana')
@section('meta_description', $page->meta_description ?: Str::limit(strip_tags($page->content), 160))

@section('content')

    <div class="bg-light py-3 border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Acasă</a></li>
                    <li class="breadcrumb-item active">{{ $page->title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <h1 class="fw-bold mb-0">{{ $page->title }}</h1>
                        @auth
                            <a href="{{ route('admin.pages.edit', $page) }}" class="admin-edit-btn flex-shrink-0" style="display:inline-flex;align-items:center;gap:4px;background:#f39c12;color:#fff;border-radius:20px;padding:4px 12px;font-size:.75rem;font-weight:600;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,.15)">
                                <i class="bi bi-pencil-fill" style="font-size:.7rem"></i> Editează pagina
                            </a>
                        @endauth
                    </div>
                    <article class="article-content">
                        {!! $page->content !!}
                    </article>
                </div>
            </div>
        </div>
    </section>

@endsection
