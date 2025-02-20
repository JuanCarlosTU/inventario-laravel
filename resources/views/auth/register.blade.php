<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="p-4 border rounded shadow bg-white">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <x-input-label for="name" :value="__('Name')" class="form-label" />
            <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="text-danger mt-1" />
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" class="form-label" />
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="text-danger mt-1" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" class="form-label" />
            <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="text-danger mt-1" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="form-label" />
            <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger mt-1" />
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <a class="text-decoration-none text-primary" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <x-primary-button class="btn btn-primary">
                {{ __('Register') }}
            </x-primary-button>
            <a href="{{ route('paypal.subscribe', 'ID_DEL_PLAN') }}">
                <button>Suscribirme por $10/mes</button>
            </a>
            
        </div>
    </form>
</x-guest-layout>
