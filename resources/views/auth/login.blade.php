<x-guest-layout>

    <div class="p-4 mb-4 text-center shadow-md">
        <img src="{{ asset('vendor/adminlte/dist/img/logo_ubosque.png') }}" alt="Logo UBosque" class="max-w-xs mx-auto" width="200" height="150">
        <!-- Imagen -->
        <h1 class="mb-2 text-3xl font-extrabold">SIPRE-UEB</h1>
    </div>

    <!-- Resto del formulario -->
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="mb-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Usuario')" />
            <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block w-full mt-1"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Captcha -->
        <div class="mt-4">
            <div class="mb-4">
                {!! captcha_img('flat') !!}
            </div>
            <x-input-label for="captcha" :value="__('Captcha')" />
            <x-text-input id="captcha" class="block w-full mt-1" type="text" name="captcha" required autocomplete="off" />
            <x-input-error :messages="$errors->get('captcha')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Recordar datos') }}</span>
            </label>
        </div>

        <div class="mt-4">
            <x-primary-button class="items-center justify-center w-full mx-auto">
                {{ __('Ingresar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
