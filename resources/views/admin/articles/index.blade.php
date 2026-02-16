@extends('layouts.admin')
@section('title', 'Articole')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <p class="text-muted mb-0">Total: {{ $articles->total() }} articole</p>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Adaugă articol
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Imagine</th>
                        <th>Titlu</th>
                        <th>Companie</th>
                        <th>Status</th>
                        <th>Data publicării</th>
                        <th style="width:120px">Acțiuni</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                    <tr>
                        <td>
                            @if($article->cover_image)
                                <img src="{{ $article->cover_image_url }}" alt="" style="width:60px;height:40px;object-fit:cover;border-radius:6px">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center" style="width:60px;height:40px;border-radius:6px">
                                    <i class="bi bi-image text-muted small"></i>
                                </div>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ Str::limit($article->title, 45) }}</td>
                        <td class="small text-muted">{{ $article->company->name ?? '–' }}</td>
                        <td>
                            @if($article->is_published)
                                <span class="badge bg-success">Publicat</span>
                            @else
                                <span class="badge bg-secondary">Ciornă</span>
                            @endif
                        </td>
                        <td class="small text-muted">{{ $article->published_at ? $article->published_at->format('d.m.Y H:i') : '–' }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-outline-primary" title="Editează">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" onsubmit="return confirm('Sigur ștergi articolul?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Șterge">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Niciun articol.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $articles->links() }}
    </div>

@endsection
