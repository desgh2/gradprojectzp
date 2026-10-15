<div>
    @include('breadcrumbs', [
        'breadcrumbs' => [
            $category->slug => $category->name,
        ],
    ])
    <div class="container">
        <div class="row">
            @if ($category->subcategories->isNotEmpty())
                <div class="category-sidebar col-12 col-lg-3">
                    <ul class="category-nav">
                        @foreach ($category->subcategories as $item)
                        <li>
                            <a href="{{ route('front.subcategory', ['parent' => $category->slug, 'category' => $item->slug]) }}">{{ $item->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="category-main col-12 col-lg-8 offset-lg-1">
                    <h1 class="category-title">{{ $category->heading }}</h1>
                    {!! $category->text !!}
                </div>
            @else
                <div class="category-main col-12 col-lg-8 offset-lg-2">
                    <h1 class="category-title">{{ $category->heading }}</h1>
                    {!! $category->text !!}
                </div>
            @endif
        </div>
    </div>
</div>
