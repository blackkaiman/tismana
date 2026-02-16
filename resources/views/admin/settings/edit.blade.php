@extends('layouts.admin')
@section('title', 'Setări site')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @foreach($groups as $groupName => $groupSettings)
            <div class="card mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold">
                        @switch($groupName)
                            @case('homepage') <i class="bi bi-house me-2"></i>Pagina principală @break
                            @case('contact')  <i class="bi bi-envelope me-2"></i>Informații contact @break
                            @case('general')  <i class="bi bi-gear me-2"></i>Setări generale @break
                            @default          <i class="bi bi-folder me-2"></i>{{ ucfirst($groupName) }}
                        @endswitch
                    </h5>
                </div>
                <div class="card-body">
                    @foreach($groupSettings as $setting)
                        <div class="mb-3">
                            <label class="form-label fw-semibold">{{ $setting->label }}</label>

                            @if($setting->type === 'textarea')
                                <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="4">{{ old('settings.' . $setting->key, $setting->value) }}</textarea>

                            @elseif($setting->type === 'image')
                                @if($setting->value)
                                    <div class="mb-2">
                                        <img src="{{ Storage::url($setting->value) }}" alt="{{ $setting->label }}" style="max-height:80px;border-radius:8px">
                                    </div>
                                @endif
                                <input type="file" name="settings[{{ $setting->key }}]" class="form-control" accept="image/*">
                                <small class="text-muted">Lasă gol pentru a păstra imaginea existentă.</small>

                            @else
                                <input type="text" name="settings[{{ $setting->key }}]" class="form-control"
                                       value="{{ old('settings.' . $setting->key, $setting->value) }}">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="text-end">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-check-lg me-2"></i>Salvează setările
            </button>
        </div>
    </form>

@endsection
