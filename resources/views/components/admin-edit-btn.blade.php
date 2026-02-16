@auth
<a href="{{ $url }}" class="admin-edit-btn" title="{{ $label ?? 'Editează' }}" style="
    display:inline-flex;align-items:center;justify-content:center;gap:4px;
    background:#f39c12;color:#fff;border-radius:20px;padding:4px 12px;
    font-size:.75rem;font-weight:600;text-decoration:none;
    box-shadow:0 2px 8px rgba(0,0,0,.15);transition:all .2s;
    position:{{ $position ?? 'relative' }};z-index:100;
    {{ $extra ?? '' }}
">
    <i class="bi bi-pencil-fill" style="font-size:.7rem"></i>
    <span>{{ $label ?? 'Editează' }}</span>
</a>
@endauth
