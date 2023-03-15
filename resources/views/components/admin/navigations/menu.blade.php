<li class="nav-item">
    <a class="nav-link collapsed" href="#collapse{{ $title }}" data-bs-toggle="collapse" role="button">
        <i class="{{ $icon }}"></i>
        <span>{{ $title }}</span>
    </a>
    <div id="collapse{{ $title }}" @class(['collapse', 'show' => $isActive])>
        <div class="bg-white py-2 collapse-inner rounded">
            {{ $slot }}
        </div>
    </div>
</li>
