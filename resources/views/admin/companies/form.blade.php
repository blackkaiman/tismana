@extends('layouts.admin')
@section('title', isset($company) ? 'Editează: ' . $company->name : 'Adaugă companie')

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
                          action="{{ isset($company) ? route('admin.companies.update', $company) : route('admin.companies.store') }}"
                          enctype="multipart/form-data">
                        @csrf
                        @if(isset($company)) @method('PUT') @endif

                        {{-- NUME --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nume companie <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $company->name ?? '') }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- SLUG --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Slug</label>
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                                   value="{{ old('slug', $company->slug ?? '') }}" placeholder="se generează automat">
                            @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- DESCRIERE --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Descriere</label>
                            <textarea name="description" class="form-control" rows="4">{{ old('description', $company->description ?? '') }}</textarea>
                        </div>

                        {{-- LOGO --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Logo</label>
                            @if(isset($company) && $company->logo)
                                <div class="mb-2">
                                    <img src="{{ $company->logo_url }}" alt="Logo actual" style="max-height:60px">
                                </div>
                            @endif
                            <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                            @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <small class="text-muted">Max 2MB. Formate: JPG, PNG, WEBP.</small>
                        </div>

                        <hr>

                        {{-- CONTACT --}}
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $company->email ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Telefon</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $company->phone ?? '') }}">
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Website</label>
                                <input type="url" name="website" class="form-control" value="{{ old('website', $company->website ?? '') }}" placeholder="https://">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Adresă</label>
                                <input type="text" name="address" class="form-control" value="{{ old('address', $company->address ?? '') }}">
                            </div>
                        </div>

                        <hr>

                        {{-- SEO --}}
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $company->meta_title ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Meta Description</label>
                                <input type="text" name="meta_description" class="form-control" value="{{ old('meta_description', $company->meta_description ?? '') }}">
                            </div>
                        </div>

                        {{-- STATUS + ORDINE --}}
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive"
                                           {{ old('is_active', $company->is_active ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="isActive">Companie activă</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Ordine afișare</label>
                                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $company->sort_order ?? 0) }}" min="0">
                            </div>
                        </div>

                        {{-- BUTOANE --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.companies.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Înapoi
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-lg me-1"></i>{{ isset($company) ? 'Actualizează' : 'Salvează' }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
