@extends('layouts.admin')
@section('title', 'Pagini')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <p class="text-muted mb-0">Total: {{ $pages->count() }} pagini</p>
        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Adaugă pagină
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:50px">#</th>
                        <th>Titlu</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Ultima modificare</th>
                        <th style="width:120px">Acțiuni</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                    <tr>
                        <td class="text-muted">{{ $page->sort_order }}</td>
                        <td class="fw-semibold">{{ $page->title }}</td>
                        <td class="small text-muted">/pagina/{{ $page->slug }}</td>
                        <td>
                            @if($page->is_published)
                                <span class="badge bg-success">Publicată</span>
                            @else
                                <span class="badge bg-secondary">Ciornă</span>
                            @endif
                        </td>
                        <td class="small text-muted">{{ $page->updated_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-outline-primary" title="Editează">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" onsubmit="return confirm('Sigur ștergi pagina?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Șterge">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Nicio pagină.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
