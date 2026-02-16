@extends('layouts.admin')
@section('title', isset($page) ? 'Editează: ' . $page->title : 'Adaugă pagină')

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body p-4">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form method="POST"
                          action="{{ isset($page) ? route('admin.pages.update', $page) : route('admin.pages.store') }}">
                        @csrf
                        @if(isset($page)) @method('PUT') @endif

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Titlu <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $page->title ?? '') }}" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ old('slug', $page->slug ?? '') }}" placeholder="se generează automat">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Conținut <span class="text-danger">*</span></label>
                            <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="15" required>{{ old('content', $page->content ?? '') }}</textarea>
                            @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">Poți folosi HTML pentru formatare.</small>
                        </div>

                        <hr>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $page->meta_title ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Meta Description</label>
                                <input type="text" name="meta_description" class="form-control" value="{{ old('meta_description', $page->meta_description ?? '') }}">
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_published" value="1" id="isPublished"
                                           {{ old('is_published', $page->is_published ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="isPublished">Publicată</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Ordine afișare</label>
                                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $page->sort_order ?? 0) }}" min="0">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.pages.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Înapoi
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-1"></i>{{ isset($page) ? 'Actualizează' : 'Salvează' }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
