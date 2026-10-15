<div class="collapse navbar-collapse" id="mobileMenu">
    @forelse ($primary_menu as $menu)
        <div>
            <a class="nav-link" href="{{ route('front.category', ['category' => $menu->slug]) }}">{{ $menu->name }}</a>
        </div>
    @empty
    @endforelse
    <div>
        <a class="nav-link" href="{{ route('front.advert') }}">Розміщення рекламних бордів</a>
    </div>
</div>
