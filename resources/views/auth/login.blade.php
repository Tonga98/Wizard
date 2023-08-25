<x-guest-layout>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Dni number -->
        <div>
            <x-input-label for="dni_num" :value="__('DNI')" />
            <x-text-input id="dni_num" class="block mt-1 w-full" type="number" name="dni_num" :value="old('email')" required autofocus autocomplete="dni_num" />
            <x-input-error :messages="$errors->get('dni_num')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Iniciar sesion') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
