<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
        {{ __('Login to your account') }}
    </h1>
    <form method="POST" action="{{ route('login') }}" class="space-y-4 md:space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Your email')" />
            <x-text-input id="email" class="block mt-1 w-full" 
                            type="email"
                            name="email" 
                            :value="old('email')" 
                            required 
                            autofocus autocomplete="username" 
                            placeholder="name@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" 
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <!-- Remember Me -->
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="remember_me" type="checkbox" 
                            class="rounded dark:bg-blue-900 border-blue-300 dark:border-blue-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-blue-800" 
                            name="remember">
                </div>
                <div class="ml-3 text-sm">
                    <label for="remember_me" class="inline-flex items-center">
                        <span class="ml-2 text-sm text-blue-600 dark:text-blue-400">{{ __('Remember me') }}</span>
                    </label>
                </div>
            </div>
            @if (Route::has('password.request'))
                <a class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
        <x-primary-button>
            {{ __('Login') }}
        </x-primary-button>
        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
            {{ __("Don't have an account yet?") }}
            <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:underline dark:text-blue-500">
                {{ __('Join us') }}
            </a>
        </p>
    </form>
</x-guest-layout>
