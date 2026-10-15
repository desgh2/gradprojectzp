@extends('layouts.app')
@section('title', 'Карта сторінок')
@section('description', 'Карта сторінок')
@section('content')
    <div class="container my-3">
        <h1 class="text-center mb-5 mt-3">Карта сайта</h1>
        <ul>
            @foreach (App\Models\Category::getPrimaryMenu() as $category)
                <li><a href="{{ route('front.category', ['category' => $category->slug]) }}" class="my-2 f5-3">{{ $category->name }}</a>
                    @if ($category->subcategories->isNotEmpty())
                    <ul style="margin-left: 20px;">
                        @foreach ($category->subcategories as $item)
                            <li><a href="{{ route('front.subcategory', ['parent' => $category->slug, 'category' => $item->slug]) }}" class="ms-3 fs-6">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
@endsection
