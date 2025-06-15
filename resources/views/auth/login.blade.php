<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-white px-4 py-12">
        <div class="w-full max-w-md bg-white border border-gray-200 rounded-xl shadow-md p-8">
            <!-- Title -->
            <div>
                <a href="/">
                    <center><x-application-logo class="w-20 h-20 fill-current text-gray-500" /></center>
                </a>
            </div>
            <h2 class="text-2xl font-bold text-violet-700 text-center mb-6">Se connecter</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-violet-700 font-semibold" />
                    <x-text-input
                        id="email"
                        class="mt-1 block w-full border-gray-300 focus:border-violet-500 focus:ring-violet-500 rounded-md shadow-sm"
                        type="email"
                        name="email"
                        :value="old('email')"
                        required
                        autofocus
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-violet-700 font-semibold" />
                    <x-text-input
                        id="password"
                        class="mt-1 block w-full border-gray-300 focus:border-violet-500 focus:ring-violet-500 rounded-md shadow-sm"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-6">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-violet-600 shadow-sm focus:ring-violet-500" name="remember">
                    <label for="remember_me" class="ml-2 text-sm text-gray-700">
                        {{ __('Remember me') }}
                    </label>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-between">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-violet-600 hover:underline" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="bg-violet-600 hover:bg-violet-700 focus:ring-violet-500">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
