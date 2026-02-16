@extends('layouts.admin')
@section('title', isset($article) ? 'Editează: ' . Str::limit($article->title, 30) : 'Adaugă articol')

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body p-4">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form method="POST"
                          action="{{ isset($article) ? route('admin.articles.update', $article) : route('admin.articles.store') }}"
                          enctype="multipart/form-data">
                        @csrf
                        @if(isset($article)) @method('PUT') @endif

                        {{-- COMPANIE --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Companie <span class="text-danger">*</span></label>
                            <select name="company_id" class="form-select @error('company_id') is-invalid @enderror" required>
                                <option value="">— Selectează compania —</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id', $article->company_id ?? '') == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- TITLU --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Titlu <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $article->title ?? '') }}" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- SLUG --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug', $article->slug ?? '') }}" placeholder="se generează automat">
                        </div>

                        {{-- EXCERPT --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Rezumat (excerpt)</label>
                            <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
                        </div>

                        {{-- CONTENT --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Conținut <span class="text-danger">*</span></label>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="12" required>{{ old('content', $article->content ?? '') }}</textarea>
                            @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">Poți folosi taguri HTML pentru formatare.</small>
                        </div>

                        {{-- COVER IMAGE --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Imagine copertă</label>
                            @if(isset($article) && $article->cover_image)
                                <div class="mb-2">
                                    <img src="{{ $article->cover_image_url }}" alt="Copertă actuală" style="max-height:100px;border-radius:8px">
                                </div>
                            @endif
                            <input type="file" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror" accept="image/*">
                            @error('cover_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">Max 3MB. Formate: JPG, PNG, WEBP.</small>
                        </div>

                        <hr>

                        {{-- SEO --}}
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $article->meta_title ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Meta Description</label>
                                <input type="text" name="meta_description" class="form-control" value="{{ old('meta_description', $article->meta_description ?? '') }}">
                            </div>
                        </div>

                        {{-- PUBLICARE --}}
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_published" value="1" id="isPublished"
                                           {{ old('is_published', $article->is_published ?? false) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="isPublished">Publicat</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Data publicării</label>
                                <input type="datetime-local" name="published_at" class="form-control"
                                       value="{{ old('published_at', isset($article) && $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : '') }}">
                            </div>
                        </div>

                        {{-- BUTOANE --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Înapoi
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-1"></i>{{ isset($article) ? 'Actualizează' : 'Salvează' }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
