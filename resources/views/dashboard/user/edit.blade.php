@extends('layouts.master')
@section('title', 'Редагувати користувача')
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
    <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST" enctype="multipart/form-data" x-data="{
        pass: '',
    }">
    @method('PATCH')
        @csrf

        <div class="row g-4 settings-section">
            <div class="col-12 col-md-4">
                <div class="section-intro">Поля позначені <span class="text-danger">*</span> - обов`язкові для заповнення
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">
                        <div class="settings-form">
                            <div class="mb-4">
                                <label for="name" class="form-label">І`мя <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name') ?? $user->name }}" placeholder="" required="">
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label">E-mail <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" id="email"
                                    value="{{ old('email') ?? $user->email }}" placeholder="" required="">
                            </div>
                            <div class="input-group mb-4">
                                <input type="text" x-model="pass" name="password" class="form-control"
                                    placeholder="Пароль">
                                <button class="btn btn-secondary" @click="pass = (Math.random()+1).toString(36).slice(-8)"
                                    type="button" id="button-addon2">Генерувати новий пароль</button>
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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
