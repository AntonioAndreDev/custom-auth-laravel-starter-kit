<x-layouts.auth-layout pageTitle="Login">
    <div class="bg-laravel-black-100 lg:w-1/2 lg:mx-auto sm:p-6 p-4 rounded-2xl shadow-xl">
        <h2 class="text-center text-2xl/9 font-bold tracking-tight text-white">Login to your account</h2>

        <form class="space-y-4 mt-4" action="{{ route('authenticate') }}" method="POST" novalidate>
            @csrf
            <div>
                <label for="email" class="block text-sm/6 font-medium text-white">Email</label>
                <div class="mt-2">
                    <input type="email" name="email" id="email" autocomplete="email" required
                           value="{{ old('email') }}"
                           class="block w-full text-white rounded-md bg-laravel-black-900 p-3 text-base placeholder:text-laravel-gray-300 focus:outline-2 focus:outline-offset-2 focus:outline-laravel-yellow-300 sm:text-sm/6">
                </div>
                @error('email')
                <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm/6 font-medium text-white">Password</label>
                </div>
                <div class="mt-2">
                    <input type="password" name="password" id="password" autocomplete="current-password" required
                           value="{{ old('password') }}"
                           class="block w-full text-white rounded-md bg-laravel-black-900 p-3 text-base placeholder:text-laravel-gray-300 focus:outline-2 focus:outline-offset-2 focus:outline-laravel-yellow-300 sm:text-sm/6">
                </div>
                @error('password')
                <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-sm text-end">
                <a href="{{ route('forgotPassword') }}"
                   class="font-semibold text-laravel-yellow-300 hover:text-laravel-yellow-300/90">Forgot
                    password?</a>
            </div>

            <div>
                <button type="submit"
                        class="flex cursor-pointer w-full justify-center rounded-md bg-laravel-yellow-100 p-3 text-sm/6 font-semibold text-black shadow-xs hover:bg-laravel-yellow-100/90 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-laravel-yellow-300">
                    Sign in with email
                </button>
            </div>
        </form>

        @if(session('invalid_login'))
            <div class="flex justify-center items-center bg-red-400 text-white rounded-md py-3 mt-4">
                <p>{{ session('invalid_login') }}</p>
            </div>
        @endif

        @if(session('password_reset'))
            <div class="flex justify-center items-center bg-green-400 text-white rounded-md py-3 mt-4">
                <p>{{ session('password_reset') }}</p>
            </div>
        @endif

        @if(session('account_deleted'))
            <div class="flex justify-center items-center bg-green-400 text-white rounded-md py-3 mt-4">
                <p>{{ session('account_deleted') }}</p>
            </div>
        @endif

        <div class="relative flex my-8 items-center">
            <div class="flex-grow border-t border-laravel-gray-200"></div>
            <span class="flex-shrink mx-4 text-laravel-gray-300">Or login with</span>
            <div class="flex-grow border-t border-laravel-gray-200"></div>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div
                class="flex border border-laravel-gray-200 w-full gap-x-4 items-center justify-center rounded-md py-3 px-12">
                <img src="{{ asset('assets/google.png') }}" alt="Google logo">
                <p class="text-lg text-white">Google</p>
            </div>

            <div
                class="flex border border-laravel-gray-200 w-full gap-x-4 items-center justify-center rounded-md py-3 px-12">
                <img src="{{ asset('assets/apple.png') }}" alt="Apple logo">
                <p class="text-lg text-white">Apple</p>
            </div>
        </div>

        <p class="mt-10 text-center text-sm/6 text-gray-500">
            Don’t have an account?
            <a href="{{ route('register') }}"
               class="font-semibold text-laravel-yellow-300 hover:text-laravel-yellow-300/90">
                Get Started
            </a>
        </p>
    </div>
</x-layouts.auth-layout>
