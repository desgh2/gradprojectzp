<div>
    @include('breadcrumbs', [
        'breadcrumbs' => [
            $parent->slug => $parent->name,
            $category->slug => $category->name,
        ],
    ])
    <div class="container">
        <div class="row">
            <div class="category-sidebar col-12 col-lg-3">
                <ul class="category-nav">
                    @foreach ($category->related() as $item)
                        <li>
                            <a class="{{ \Str::contains(last(request()->segments()), $item->slug) ? 'active' : '' }}" href="{{ route('front.subcategory', ['parent' => $parent->slug, 'category' => $item->slug]) }}">{{ $item->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="category-main col-12 col-lg-8 offset-lg-1">
                @if ($category->id == 10)
                @livewire('front.persons')
                @else
                <h1 class="category-title">{{ $category->heading }}</h1>
                {!! $category->text !!}
                @endif
            </div>
        </div>
    </div>
</div>
