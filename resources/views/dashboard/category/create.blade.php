@extends('layouts.master')
@section('title', 'Додати категорію')
@section('content')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title">@yield('title')</h1>
        </div>
    </div>
    @if ($errors->any())
        <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration border-5 border-danger border-top-0 border-end-0 border-bottom-0"
            role="alert">
            <div class="inner">
                <div class="app-card-body p-3 p-lg-4">
                    <h3 class="mb-3">Помилка</h3>
                    <div class="row gx-5 gy-3">
                        <div class="col-12 col-lg-9">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><!--//col-->
                    </div><!--//row-->
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div><!--//app-card-body-->
            </div><!--//inner-->
        </div>
    @endif
    <hr class="mb-4">
    <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-12">
                <div class="section-intro">Поля позначені <span class="text-danger">*</span> - обов`язкові для заповнення
                </div>
            </div>
            <div class="col-12 col-md-9">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">
                        <div class="settings-form">
                            @if ($parents->isNotEmpty())
                                <div class="mb-4">
                                    <label for="parent" class="form-label">Категорія</label>
                                    <select class="form-select" name="parent" id="parent">
                                        <option value="">Оберіть категорію</option>
                                        @foreach ($parents as $parent)
                                            <option value="{{ $parent->id }}" @selected(old('parent') == $parent->id)>{{ $parent->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <input type="hidden" name="parent" value="">
                            @endif
                            <div class="mb-4">
                                <label for="name" class="form-label">Назва <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" onkeyup="slugify('name', 'slug')" name="name"
                                    id="name" value="{{ old('name') }}" placeholder="Реклама" required="">
                            </div>
                            <div class="mb-4">
                                <label for="slug" class="form-label">URL <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="slug" id="slug" placeholder="URL"
                                    value="{{ old('slug') }}">
                            </div>
                            <div class="mb-4">
                                <label for="title" class="form-label">Заголовок (title) <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="title"
                                    placeholder="Заголовок (title)" value="{{ old('title') }}">
                            </div>
                            <div class="mb-4">
                                <label for="description" class="form-label">Опис (description) <span
                                        class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Опис"
                                    style="min-height: 50px; max-height: 100px;">{{ old('description') }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="heading" class="form-label">Заголовок (H1) <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="heading" id="heading"
                                    placeholder="Заголовок (H1)" value="{{ old('heading') }}">
                            </div>
                            <div class="mb-4">
                                <label for="text" class="form-label">Контент <span class="text-danger">*</span></label>
                                <textarea name="text" id="text" class="form-control" placeholder="Контент">{{ old('text') }}</textarea>
                            </div>
                            <button type="submit" class="mt-3 btn app-btn-primary">Зберегти</button>
                        </div>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
            <div class="col-12 col-md-3">
                <div class="app-card app-card-settings shadow-sm p-4 mb-4">
                    <div class="app-card-body">
                        <div class="settings-form">
                            <div class="mb-4 fw-bold">Відображати в меню</div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="primary_menu" id="primary_menu">
                                <label class="form-check-label" for="primary_menu">
                                    Головне меню
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="footer_menu" id="footer_menu">
                                <label class="form-check-label" for="footer_menu">
                                    Футер меню
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="{{ asset('/js/dashboard/ckeditor/ckeditor.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('js/dashboard/slugify.js') }}"></script>
    <script src="{{ asset('js/dashboard/uploads.js') }}"></script>
    <script>
        CKEDITOR.replace('text', {
            filebrowserUploadMethod: 'form',
            font_defaultLabel: 'Roboto',
            filebrowserUploadUrl: "{{ route('fileupload', ['_token' => csrf_token()]) }}",
            height: '450px',
        });
    </script>
@endpush
