@extends('layouts.public')

@section('meta_title', 'Contact – Primăria Tismana')
@section('meta_description', 'Contactează-ne pentru informații despre proiectul de promovare a companiilor locale din Tismana.')

@section('content')

    {{-- HEADER --}}
    <section class="hero-section py-5" style="background:linear-gradient(rgba(26,82,118,.85),rgba(26,110,158,.85)),url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1yWnzDi_pu6_4yx10RXv703BfzzwLpcqonQ&s') center/cover no-repeat">
        <div class="container text-center">
            <h1><i class="bi bi-envelope me-2"></i>Contact</h1>
            <p class="lead mt-2">Trimite-ne un mesaj sau contactează-ne direct</p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            @auth
                <div class="d-flex justify-content-end gap-2 mb-3">
                    <a href="{{ route('admin.settings.edit') }}" class="admin-edit-btn" style="display:inline-flex;align-items:center;gap:4px;background:#f39c12;color:#fff;border-radius:20px;padding:4px 12px;font-size:.75rem;font-weight:600;text-decoration:none;box-shadow:0 2px 8px rgba(0,0,0,.15)">
                        <i class="bi bi-pencil-fill" style="font-size:.7rem"></i> Editează informațiile de contact
                    </a>
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-primary" style="border-radius:20px;font-size:.75rem;font-weight:600">
                        <i class="bi bi-chat-dots me-1"></i> Vezi mesajele
                    </a>
                </div>
            @endauth
            <div class="row g-5">

                {{-- FORMULAR --}}
                <div class="col-lg-7">
                    <div class="card p-4">
                        <h4 class="fw-bold mb-4"><i class="bi bi-chat-dots text-primary me-2"></i>Trimite un mesaj</h4>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('contact.store') }}">
                            @csrf

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Nume complet <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Telefon</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="subject" class="form-label">Subiect</label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}">
                                    @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label for="message" class="form-label">Mesaj <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="bi bi-send me-2"></i>Trimite mesajul
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- INFO CONTACT --}}
                <div class="col-lg-5">
                    <div class="card p-4 mb-4">
                        <h4 class="fw-bold mb-4"><i class="bi bi-info-circle text-primary me-2"></i>Informații de contact</h4>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-start mb-4">
                                <i class="bi bi-geo-alt-fill text-primary me-3 mt-1" style="font-size:1.3rem"></i>
                                <div>
                                    <strong>Adresă</strong><br>
                                    <span class="text-muted">{{ $settings['contact_address'] ?? 'Tismana, Gorj' }}</span>
                                </div>
                            </li>
                            <li class="d-flex align-items-start mb-4">
                                <i class="bi bi-telephone-fill text-primary me-3 mt-1" style="font-size:1.3rem"></i>
                                <div>
                                    <strong>Telefon</strong><br>
                                    <a href="tel:{{ $settings['contact_phone'] ?? '' }}" class="text-muted text-decoration-none">
                                        {{ $settings['contact_phone'] ?? '0253 000 000' }}
                                    </a>
                                </div>
                            </li>
                            <li class="d-flex align-items-start mb-4">
                                <i class="bi bi-envelope-fill text-primary me-3 mt-1" style="font-size:1.3rem"></i>
                                <div>
                                    <strong>Email</strong><br>
                                    <a href="mailto:{{ $settings['contact_email'] ?? '' }}" class="text-muted text-decoration-none">
                                        {{ $settings['contact_email'] ?? 'contact@tismana.ro' }}
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="card p-4 bg-primary text-white">
                        <h5 class="fw-bold mb-3"><i class="bi bi-clock me-2"></i>Program</h5>
                        <p class="mb-1">Luni – Vineri: 08:00 – 16:00</p>
                        <p class="mb-0 opacity-75">Sâmbătă – Duminică: Închis</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
