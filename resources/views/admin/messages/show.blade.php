@extends('layouts.admin')
@section('title', 'Mesaj de la ' . $message->name)

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold"><i class="bi bi-envelope-open me-2"></i>Mesaj primit</h5>
                    <span class="text-muted small">{{ $message->created_at->format('d.m.Y H:i') }}</span>
                </div>
                <div class="card-body p-4">

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-muted small mb-0">Nume</label>
                            <p class="fw-semibold mb-0">{{ $message->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small mb-0">Email</label>
                            <p class="mb-0"><a href="mailto:{{ $message->email }}">{{ $message->email }}</a></p>
                        </div>
                        @if($message->phone)
                        <div class="col-md-6">
                            <label class="form-label text-muted small mb-0">Telefon</label>
                            <p class="mb-0"><a href="tel:{{ $message->phone }}">{{ $message->phone }}</a></p>
                        </div>
                        @endif
                        @if($message->subject)
                        <div class="col-md-6">
                            <label class="form-label text-muted small mb-0">Subiect</label>
                            <p class="fw-semibold mb-0">{{ $message->subject }}</p>
                        </div>
                        @endif
                    </div>

                    <hr>

                    <label class="form-label text-muted small mb-1">Mesaj</label>
                    <div class="bg-light rounded p-3" style="white-space:pre-line">{{ $message->message }}</div>

                </div>
                <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Înapoi la mesaje
                    </a>
                    <div class="d-flex gap-2">
                        <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn btn-primary">
                            <i class="bi bi-reply me-1"></i>Răspunde
                        </a>
                        <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Sigur ștergi mesajul?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="bi bi-trash me-1"></i>Șterge
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
