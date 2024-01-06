@extends('layouts.guest')
@section('content')
    <form method="POST" action="{{ route('register') }}" class="bg-white p-4 rounded-2">
        @csrf
        <!-- Email Address -->
        <div class="form-floating">
            <x-input-float type="email" id="email" name="email" placeholder="name@example.com"
                value="{{ old('email') }}" required />
            <x-input-label for="email">E-mail</x-input-label>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Name -->
        <div class="form-floating mt-4">
            <x-input-float type="text" id="name" name="name" placeholder="Ваше Ім`я" required />
            <x-input-label for="name">Ім`я</x-input-label>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="form-floating mt-4">
            <x-input-float type="password" id="password" name="password" placeholder="Пароль" />
            <x-input-label for="password">Пароль</x-input-label>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <!-- Confirm Password -->
        <div class="form-floating mt-4">
            <x-input-float type="password" id="password_confirmation" name="password_confirmation"
                placeholder="Ваше Ім`я" />
            <x-input-label for="password_confirmation">Підтвердження паролю</x-input-label>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <div class="text-center mt-4 mb-4">
            <button type="submit" class="btn app-btn-primary">
                Зареєструватися
            </button>
        </div>
        <hr>
        <div class="text-center mt-2">
            <a href="{{ route('login') }}" class="small text-secondary">Вже зареєстровані?</a>
        </div>
    </form>
@endsection
