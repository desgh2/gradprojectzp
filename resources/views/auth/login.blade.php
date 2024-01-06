@extends('layouts.guest')
@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="bg-white p-4 rounded-2">
        @csrf
        <!-- Email Address -->
        <div class="form-floating">
            <x-input-float type="email" id="email" name="email" placeholder="name@example.com"
                value="{{ old('email') }}" required />
            <x-input-label for="email">E-mail</x-input-label>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-floating mt-4">
            <x-input-float type="password" id="password" name="password" placeholder="Пароль" />
            <x-input-label for="password">Пароль</x-input-label>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <x-input-label for="remember_me">
            <x-text-input type="checkbox" id="remember_me" name="remember" placeholder="Запам'ятати мене" />
                Запам'ятати мене
            </x-input-label>
        </div>

        <div class="text-center mt-4 mb-4">
            <button type="submit" class="btn app-btn-primary">
                Увійти
            </button>
        </div>
        {{-- <hr>
        <div class="text-center mt-2">
            <a href="{{ route('password.request') }}" class="small text-secondary">Забули пароль?</a>
        </div> --}}
    </form>
@endsection
