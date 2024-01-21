@php
    $position = 1;
    $slug = '';
@endphp
<div class="breadcrumbs py-2 ">
    <div class="container">
        <div class="row">
            <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: '|';">
                <ol class="breadcrumb my-auto" itemscope itemtype="http://schema.org/BreadcrumbList">
                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                        itemtype="http://schema.org/ListItem">
                        <a class="text-nowrap text-secondary" itemscope itemtype="http://schema.org/Thing"
                            itemprop="item" href="{{ route('front.index') }}" itemid="{{ route('front.index') }}"><span
                                itemprop="name">Главная</span>
                        </a>
                        <meta itemprop="position" content="{{ $position }}" />
                    </li>
                    @foreach ($breadcrumbs as $key => $value)
                        @php
                            $position++;
                            $slug .= $key . '/';
                        @endphp
                        <li class="breadcrumb-item" itemprop="itemListElement" itemscope
                            itemtype="http://schema.org/ListItem">
                            <a itemscope itemtype="http://schema.org/Thing" itemprop="item"
                                href="{{ route('front.index') }}/{{ \Str::replaceLast('/', '', $slug) }}"
                                itemid="{{ $key }}">{{ $value }}</a>
                            <meta itemprop="position" content="{{ $position }}" />
                        </li>
                    @endforeach
                </ol>
            </nav>
        </div>
    </div>
</div>
