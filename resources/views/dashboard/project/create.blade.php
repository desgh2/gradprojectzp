@extends('layouts.master')
@section('title', 'Додати проєкт')
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
    <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data">
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
                                <label for="department_id" class="form-label">Оберіть відділ <span class="text-danger">*</span></label>
                                <select class="form-select" name="department_id" id="department_id">
                                    <option value="">Оберіть відділ</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" @selected(old('department_id') == $department->id)>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="name" class="form-label">Назва <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" onkeyup="slugify('name', 'slug')" name="name"
                                    id="name" value="{{ old('name') }}">
                            </div>
                            <div class="mb-4">
                                <label for="slug" class="form-label">URL <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}">
                            </div>
                            <div class="mb-4">
                                <label for="title" class="form-label">Заголовок (title) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                            </div>
                            <div class="mb-4">
                                <label for="description" class="form-label">Опис (description) <span class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control" rows="3" style="min-height:60px; max-height: 100px;">{{ old('description') }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="heading" class="form-label">Заголовок (H1) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="heading" id="heading" value="{{ old('heading') }}">
                            </div>
                            <div class="mb-4">
                                <label for="short_text" class="form-label">Короткий опис <span class="text-danger">*</span></label>
                                <textarea name="short_text" id="short_text" class="form-control" rows="3" style="min-height:60px; max-height: 100px;">{{ old('short_text') }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="address" class="form-label">Адреса об`єкта <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}">
                            </div>
                            <div class="mb-4">
                                <label for="type" class="form-label">Тип об`єкта <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="type" id="type" value="{{ old('type') }}">
                            </div>
                            <div class="mb-4">
                                <label for="do_work" class="form-label">Вид роботи на об`єкті <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="do_work" id="do_work" value="{{ old('do_work') }}">
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
    <script src="https://cdn.tiny.cloud/1/r05xjzvpqt372x23foc7epd3u8pazaizje6fw8s5t603fcm0/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="{{ asset('js/dashboard/editor.js') }}"></script>
    <script src="{{ asset('js/dashboard/slugify.js') }}"></script>
    <script src="{{ asset('js/dashboard/uploads.js') }}"></script>
@endpush
@push('css')
    <style>
        .fileUpload {
            position: relative;
        }

        .fileUpload input.upload {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        input[type="file"] {
            position: fixed;
            right: 100%;
            bottom: 100%;
        }

        #preview img {
            max-height: 100px;
        }

        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 50px auto;

            .avatar-edit {
                position: absolute;
                right: 12px;
                z-index: 1;
                top: 10px;

                input {
                    display: none;

                    +label {
                        display: inline-block;
                        width: 34px;
                        height: 34px;
                        margin-bottom: 0;
                        border-radius: 100%;
                        background: #FFFFFF;
                        border: 1px solid transparent;
                        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
                        cursor: pointer;
                        font-weight: normal;
                        transition: all .2s ease-in-out;

                        &:hover {
                            background: #f1f1f1;
                            border-color: #d6d6d6;
                        }

                        &:after {
                            content: "\f040";
                            font-family: 'FontAwesome';
                            color: #757575;
                            position: absolute;
                            top: 10px;
                            left: 0;
                            right: 0;
                            text-align: center;
                            margin: auto;
                        }
                    }
                }
            }

            .avatar-preview {
                width: 100%;
                height: auto;
                position: relative;
                border-radius: 5px;
                border: 6px solid #F8F8F8;
                box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);

                >div {
                    width: 100%;
                    height: 100%;
                    border-radius: 5px;
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-position: center;
                }
            }
        }
    </style>
@endpush
