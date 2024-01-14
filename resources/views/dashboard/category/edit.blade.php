@extends('layouts.master')
@section('title', 'Редагування категорію')
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
    <form action="{{ route('category.update', ['category' => $category->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-3">
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
                                        {{-- <option value="">Оберіть категорію</option> --}}\
                                        @if ($category->parent)
                                        <option value="">Оберіть категорію</option>
                                        @foreach ($parents as $parent)
                                            <option value="{{ $parent->id }}" @selected($parent->id  == $category->parent)>{{ $parent->name }}</option>
                                        @endforeach
                                        @else

                                        @endif
                                        <option value="">Оберіть категорію</option>
                                        @foreach ($parents as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            @else
                                <input type="hidden" name="parent" value="">
                            @endif
                            <div class="mb-4">
                                <label for="name" class="form-label">Назва <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name"
                                    id="name" value="{{ old('name') ?? $category->name }}" placeholder="Реклама" required="">
                            </div>
                            <div class="mb-4">
                                <label for="slug" class="form-label">URL <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="slug" id="slug" placeholder="URL"
                                    value="{{ old('slug') ?? $category->slug }}">
                            </div>
                            <div class="mb-4">
                                <label for="title" class="form-label">Заголовок (title) <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="title"
                                    placeholder="Заголовок (title)" value="{{ old('title') ?? $category->title }}">
                            </div>
                            <div class="mb-4">
                                <label for="description" class="form-label">Опис (description) <span
                                        class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Опис"
                                    style="min-height: 50px; max-height: 100px;">{{ old('description') ?? $category->description }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="heading" class="form-label">Заголовок (H1) <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="heading" id="heading"
                                    placeholder="Заголовок (H1)" value="{{ old('heading') ?? $category->heading }}">
                            </div>
                            <div class="mb-4">
                                <label for="text" class="form-label">Контент <span class="text-danger">*</span></label>
                                <textarea name="text" id="text" class="form-control" placeholder="Контент">{{ old('text') ?? $category->text }}</textarea>
                            </div>
                            <button type="submit" class="mt-3 btn app-btn-primary">Зберегти</button>
                        </div>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="https://cdn.tiny.cloud/1/r05xjzvpqt372x23foc7epd3u8pazaizje6fw8s5t603fcm0/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#text',
            plugins: 'advlist autolink lists link image charmap preview anchor pagebreak image imagetools table',
            toolbar: ["styleselect fontselect fontsizeselect",
                "undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify table",
                "bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code"
            ],
            images_upload_url: 'postAcceptor.php',
            automatic_uploads: false,
            height: '600px',
            language: 'ru'
        });
    </script>
    <script src="{{ asset('js/dashboard/slugify.js') }}"></script>
@endpush
