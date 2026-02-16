@extends('layouts.admin')
@section('title', 'Mesaje contact')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <p class="text-muted mb-0">Total: {{ $messages->total() }} mesaje</p>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width:30px"></th>
                        <th>Nume</th>
                        <th>Email</th>
                        <th>Subiect</th>
                        <th>Data</th>
                        <th style="width:120px">Acțiuni</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $msg)
                    <tr class="{{ $msg->is_read ? '' : 'table-primary' }}">
                        <td>
                            @if(!$msg->is_read)
                                <span class="badge bg-danger rounded-circle p-1">&nbsp;</span>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $msg->name }}</td>
                        <td class="small">{{ $msg->email }}</td>
                        <td class="small text-muted">{{ Str::limit($msg->subject ?: $msg->message, 50) }}</td>
                        <td class="small text-muted">{{ $msg->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.messages.show', $msg) }}" class="btn btn-outline-primary" title="Citește">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.messages.destroy', $msg) }}" onsubmit="return confirm('Sigur ștergi mesajul?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Șterge">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Niciun mesaj primit.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $messages->links() }}
    </div>

@endsection
