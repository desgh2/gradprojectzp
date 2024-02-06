@extends('layouts.master')
@section('title', 'Додати новину')
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
    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4 settings-section">
            <div class="col-12">
                <div class="section-intro">Поля позначені <span class="text-danger">*</span> - обов`язкові для заповнення
                </div>
            </div>
            <div class="col-12 col-md-9">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">
                        <div class="settings-form">
                            <div class="mb-4">
                                <label for="name" class="form-label">Назва <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" onkeyup="slugify('name', 'slug')" name="name"
                                    id="name" value="{{ old('name') }}" placeholder="">
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
                            <div class="form-group text-center">
                                <img src="" class="rounded w-100 mx-auto d-block mb-3" id="imgPreview">
                                <div class="fileUpload btn btn-success text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                        <path
                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                        <path
                                            d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                                    </svg>
                                    <input type="file" name="poster" class="form-control upload" id="imgInput"
                                        accept="image/*" />
                                    <span class="ms-2">Завантажити постер</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">
                        <div class="settings-form">
                            <div class="text-center">
                                <div id="gallery" class="row mb-4"></div>
                                <div class="fileUpload btn btn-secondary text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                        <path
                                            d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z" />
                                    </svg>
                                    <input type="file" name="gallery[]" class="form-control upload" id="gallery_upload"
                                        multiple />
                                    <span class="ms-2">Завантажити галерею</span>
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
@push('css')
    <link rel="stylesheet" href="{{ asset('css/upload.css') }}">
@endpush
