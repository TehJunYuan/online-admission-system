<x-guest-layout>
    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
        {{ __('Create an account') }}
    </h1>
    <form method="POST" action="{{ route('register') }}" class="space-y-4 md:space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block mt-1 w-full" 
                            type="text" 
                            name="name" 
                            :value="old('name')" 
                            required autofocus autocomplete="name"
                            placeholder="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" 
                            type="email" 
                            name="email" 
                            :value="old('email')" 
                            required autocomplete="username"
                            placeholder="name@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" 
                            required autocomplete="new-password" 
                            placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="terms" 
                        aria-describedby="terms" 
                        type="checkbox" 
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800" required="">
            </div>
            <div class="ml-3 text-sm">
                <label for="terms" class="font-light text-gray-500 dark:text-gray-300">
                    {{ __('I accept the ') }}
                    <a class="font-medium text-blue-600 hover:underline dark:text-blue-500" href="https://www.southern.edu.my/privacy-policy/" target="_blank">
                        {{ __('Terms and Conditions') }}
                    </a>
                </label>
            </div>
        </div>

        <x-primary-button>
            {{ __('Create an account') }}
        </x-primary-button>
        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
            {{ __('Already have an account?') }}
            <a class="font-medium text-blue-600 hover:underline dark:text-blue-500" href="{{ route('login') }}">
                {{ __('Login here') }}
            </a>
        </p>
    </form>
</x-guest-layout>
