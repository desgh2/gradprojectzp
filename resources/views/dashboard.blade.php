@extends('layouts.master')
@section('title', 'КП "Градпроєкт" - Головна сторінка')
@section('content')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title">@yield('title')</h1>
        </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-2">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <div class="stats-figure">{{ App\Models\Person::all()->count() }}</div>
                    <h4 class="stats-type mb-1">Керівників</h4>
                </div><!--//app-card-body-->
                <a class="app-card-link-mask" href="{{ route('person.index') }}"></a>
            </div><!--//app-card-->
        </div><!--//col-->

        <div class="col-6 col-lg-2">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <div class="stats-figure">{{ App\Models\Post::all()->count() }}</div>
                    <h4 class="stats-type mb-1">Новин(и)</h4>
                </div><!--//app-card-body-->
                <a class="app-card-link-mask" href="{{ route('post.index') }}"></a>
            </div><!--//app-card-->
        </div><!--//col-->

        <div class="col-6 col-lg-2">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <div class="stats-figure">{{ App\Models\Category::all()->count() }}</div>
                    <h4 class="stats-type mb-1">Категорій</h4>
                </div><!--//app-card-body-->
                <a class="app-card-link-mask" href="{{ route('category.index') }}"></a>
            </div><!--//app-card-->
        </div><!--//col-->

        <div class="col-6 col-lg-2">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <div class="stats-figure">{{ App\Models\Project::all()->count() }}</div>
                    <h4 class="stats-type mb-1">Проєктів</h4>
                </div><!--//app-card-body-->
                <a class="app-card-link-mask" href="{{ route('project.index') }}"></a>
            </div><!--//app-card-->
        </div><!--//col-->

        <div class="col-6 col-lg-2">
            <div class="app-card app-card-stat shadow-sm h-100">
                <div class="app-card-body p-3 p-lg-4">
                    <div class="stats-figure">{{ App\Models\Department::all()->count() }}</div>
                    <h4 class="stats-type mb-1">Відділів</h4>
                </div><!--//app-card-body-->
                <a class="app-card-link-mask" href="{{ route('department.index') }}"></a>
            </div><!--//app-card-->
        </div><!--//col-->
    </div>
@endsection
