<div class="row">
    @if ($footer_menu)
        @foreach ($footer_menu as $f_menu)
            <div class="col-12 col-md-6 col-lg-6">
                <div class="footer-menu">
                    <div class="footer-menu-title">{{ $f_menu->name }}</div>
                    @if ($f_menu->subcategories->isNotEmpty())
                        <ul class="footer-menu-list">
                            @foreach ($f_menu->subcategories as $item)
                                <li><a href="{{ route('front.subcategory', ['parent' => $f_menu->slug, 'category' => $item->slug]) }}">{{ $item->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>
