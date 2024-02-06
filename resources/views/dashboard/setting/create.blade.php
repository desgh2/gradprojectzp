@extends('layouts.master')
@section('title', 'Налаштування сайта')
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
    <form action="{{ route('setting.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4 settings-section">
            <div class="col-12 col-md-3">
                <div class="section-intro">Поля позначені <span class="text-danger">*</span> - обов`язкові для заповнення
                </div>
            </div>
            <div class="col-12 col-md-9">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">
                        <div class="settings-form">
                            <div class="mb-4">
                                <label for="name" class="form-label">Назва <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required="">
                            </div>
                            <div class="mb-4">
                                <label for="title" class="form-label">Заголовок (title) <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                            </div>
                            <div class="mb-4">
                                <label for="description" class="form-label">Опис (description) <span
                                        class="text-danger">*</span></label>
                                <textarea name="description" id="description" class="form-control" rows="3" placeholder="Опис"
                                    style="min-height: 50px; max-height: 100px;">{{ old('description') }}</textarea>
                            </div>
                            <div class="row md-4">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="work_time" class="form-label">Час роботи <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="work_time" id="work_time"
                                            value="{{ old('work_time') }}" placeholder="ПН-ПТ: 8:00-17:00" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="address" class="form-label">Адреса <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="address" id="address"
                                            value="{{ old('address') }}" placeholder="вул.Зелінського, 3" required="">
                                    </div>
                                </div>
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
        </div>
    </form>
@endsection
@push('scripts')
    <script src="{{ asset('/js/dashboard/ckeditor/ckeditor.js') }}" type="text/javascript" charset="utf-8"></script>
    <script>
        CKEDITOR.replace('text', {
            filebrowserUploadMethod: 'form',
            font_defaultLabel: 'Roboto',
            filebrowserUploadUrl: "{{ route('fileupload', ['_token' => csrf_token()]) }}",
            height: '450px',
        });
    </script>
@endpush
