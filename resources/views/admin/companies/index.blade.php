@extends('layouts.admin')
@section('title', 'Companii')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <p class="text-muted mb-0">Total: {{ $companies->count() }} companii</p>
        <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Adaugă companie
        </a>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:50px">#</th>
                        <th>Logo</th>
                        <th>Nume</th>
                        <th>Email</th>
                        <th>Telefon</th>
                        <th>Status</th>
                        <th>Articole</th>
                        <th style="width:120px">Acțiuni</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                    <tr>
                        <td class="text-muted">{{ $company->sort_order }}</td>
                        <td>
                            @if($company->logo)
                                <img src="{{ $company->logo_url }}" alt="" style="max-height:35px;max-width:80px;object-fit:contain">
                            @else
                                <i class="bi bi-building text-muted"></i>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $company->name }}</td>
                        <td class="small text-muted">{{ $company->email ?? '–' }}</td>
                        <td class="small text-muted">{{ $company->phone ?? '–' }}</td>
                        <td>
                            @if($company->is_active)
                                <span class="badge bg-success">Activ</span>
                            @else
                                <span class="badge bg-secondary">Inactiv</span>
                            @endif
                        </td>
                        <td><span class="badge bg-primary bg-opacity-10 text-primary">{{ $company->articles_count }}</span></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-outline-primary" title="Editează">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.companies.destroy', $company) }}" onsubmit="return confirm('Sigur ștergi compania {{ $company->name }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Șterge">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center text-muted py-4">Nicio companie adăugată.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
