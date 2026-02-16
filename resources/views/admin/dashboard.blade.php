@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

    {{-- STATISTICI --}}
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon bg-primary bg-opacity-10 text-primary"><i class="bi bi-buildings"></i></div>
                    <div>
                        <div class="text-muted small">Companii</div>
                        <div class="fw-bold fs-4">{{ $stats['companies'] }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon bg-success bg-opacity-10 text-success"><i class="bi bi-newspaper"></i></div>
                    <div>
                        <div class="text-muted small">Articole</div>
                        <div class="fw-bold fs-4">{{ $stats['articles'] }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon bg-warning bg-opacity-10 text-warning"><i class="bi bi-file-earmark-text"></i></div>
                    <div>
                        <div class="text-muted small">Pagini</div>
                        <div class="fw-bold fs-4">{{ $stats['pages'] }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card stat-card p-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="icon bg-danger bg-opacity-10 text-danger"><i class="bi bi-chat-dots"></i></div>
                    <div>
                        <div class="text-muted small">Mesaje necitite</div>
                        <div class="fw-bold fs-4">{{ $stats['unread_messages'] }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- ULTIMELE ARTICOLE --}}
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-newspaper me-1"></i>Ultimele articole</h6>
                    <a href="{{ route('admin.articles.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus"></i> Adaugă
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Titlu</th>
                                <th>Companie</th>
                                <th>Status</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestArticles as $article)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.articles.edit', $article) }}" class="text-decoration-none fw-semibold">
                                        {{ Str::limit($article->title, 35) }}
                                    </a>
                                </td>
                                <td class="text-muted small">{{ $article->company->name ?? '–' }}</td>
                                <td>
                                    @if($article->is_published)
                                        <span class="badge bg-success">Publicat</span>
                                    @else
                                        <span class="badge bg-secondary">Ciornă</span>
                                    @endif
                                </td>
                                <td class="text-muted small">{{ $article->created_at->format('d.m.Y') }}</td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted py-3">Niciun articol.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ULTIMELE MESAJE --}}
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold"><i class="bi bi-chat-dots me-1"></i>Ultimele mesaje</h6>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-primary">Vezi toate</a>
                </div>
                <div class="list-group list-group-flush">
                    @forelse($latestMessages as $msg)
                    <a href="{{ route('admin.messages.show', $msg) }}" class="list-group-item list-group-item-action {{ $msg->is_read ? '' : 'bg-primary bg-opacity-10' }}">
                        <div class="d-flex justify-content-between">
                            <strong class="small">{{ $msg->name }}</strong>
                            <small class="text-muted">{{ $msg->created_at->diffForHumans() }}</small>
                        </div>
                        <small class="text-muted">{{ Str::limit($msg->subject ?: $msg->message, 60) }}</small>
                    </a>
                    @empty
                    <div class="list-group-item text-center text-muted py-3">Niciun mesaj.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection
