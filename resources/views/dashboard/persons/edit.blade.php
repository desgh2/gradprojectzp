@extends('layouts.master')
@section('title', 'Редагування запису')
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
                            <div>Зверніть увагу</div>
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
    <form action="{{ route('person.update', ['person' => $person->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
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
                                <label for="surname" class="form-label">Прізвище <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="surname" id="surname" value="{{ old('surname') ?? $person->surname }}" placeholder="Doe" required="">
                            </div>
                            <div class="mb-4">
                                <label for="name" class="form-label">І`мя <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ?? $person->name }}" placeholder="John" required="">
                            </div>
                            <div class="mb-4">
                                <label for="byfather" class="form-label">По-батькові <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="byfather" id="byfather" value="{{ old('byfather') ?? $person->byfather }}" placeholder="Steve" required="">
                            </div>
                            <div class="mb-4">
                                <label for="post" class="form-label">Посада <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="post" id="post" value="{{ old('post') ?? $person->post }}" placeholder="Директор" required="">
                            </div>
                            <div class="mb-4">
                                <label for="photo" class="form-label">Фото</label>
                                <input type="file" class="form-control" name="photo" id="photo">
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="mb-4">
                                    <label for="phone" class="form-label">Телефон</label>
                                    <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') ?? $person->phone }}" placeholder="067 777 77 77">
                                </div>
                                <div class="mb-4">
                                    <label for="office_number" class="form-label">№ Кабінета</label>
                                    <input type="text" class="form-control" name="office_number" id="office_number" value="{{ old('office_number') ?? $person->office_number }}" placeholder="108">
                                </div>
                                <div class="mb-4">
                                    <label for="address" class="form-label">Адреса</label>
                                    <input type="text" class="form-control" name="address" id="address" value="{{ old('address') ?? $person->address }}" placeholder="вул.Зелінського, 3, м.Запоріжжя, 69126">
                                </div>
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
                                <img src='{{ asset("uploads/photos/{$person->photo}") }}' class="rounded w-100 mx-auto d-block mb-3" id="imgPreview">
                                <div class="fileUpload btn btn-success text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                        <path
                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                        <path
                                            d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                                    </svg>
                                    <input type="file" name="photo" class="form-control upload" id="imgInput"
                                        accept="image/*" />
                                    <span class="ms-2">Завантажити фото</span>
                                </div>
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
