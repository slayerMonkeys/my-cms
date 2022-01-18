<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse{{ $title }}" aria-expanded="true" aria-controls="collapse{{ $title }}">
        <i class="{{ $icon }}"></i>
        <span>{{ $title }}</span>
    </a>
    <div id="collapse{{ $title }}" class="collapse" aria-labelledby="heading{{ $title }}" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            {{ $slot }}
        </div>
    </div>
</li>
