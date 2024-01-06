<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register" class="bg-white rounded-2 w-100 m-auto p-5">
        <!-- Email Address -->
        <div class="form-floating">
            <x-input-float wire:model="email" type="email" id="email" name="email" placeholder="name@example.com"/>
            <x-input-label for="email">E-mail</x-input-label>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <!-- Name -->
        <div class="form-floating mt-4">
            <x-input-float wire:model="name" type="text" id="name" name="name" placeholder="Ваше Ім`я"/>
            <x-input-label for="name">Ім`я</x-input-label>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <!-- Password -->
        <div class="form-floating mt-4">
            <x-input-float wire:model="password" type="password" id="password" name="password" placeholder="Пароль"/>
            <x-input-label for="password">Пароль</x-input-label>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <!-- Confirm Password -->
        <div class="form-floating mt-4">
            <x-input-float wire:model="password_confirmation" type="password" id="password_confirmation" name="password_confirmation" placeholder="Ваше Ім`я"/>
            <x-input-label for="password_confirmation">Підтвердження паролю</x-input-label>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('login') }}" wire:navigate>
                {{ __('Вже зареєстровані?') }}
            </a>

            <x-primary-button class="btn-lg btn-primary">
                {{ __('Зареєструватися') }}
            </x-primary-button>
        </div>
    </form>
</div>
