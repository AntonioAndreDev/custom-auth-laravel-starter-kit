<x-layouts.auth-layout pageTitle="Criar conta">
    <div class="bg-laravel-black-100 lg:w-1/2 lg:mx-auto sm:p-6 p-4 rounded-2xl shadow-xl">
        <h2 class="text-center text-2xl/9 font-bold tracking-tight text-white">Create your ID</h2>

        <form class="space-y-4 mt-4" action="{{ route('storeUser') }}" method="POST" novalidate>
            @csrf
            <div class="grid sm:grid-cols-2 gap-4">
                <div>
                    <label for="first_name" class="block text-sm/6 font-medium text-white">First name</label>
                    <div class="mt-2">
                        <input type="text" name="first_name" id="first_name" autocomplete="first_name" required
                               value="{{ old('first_name') }}"
                               class="block w-full text-white rounded-md bg-laravel-black-900 p-3 text-base placeholder:text-laravel-gray-300 focus:outline-2 focus:outline-offset-2 focus:outline-laravel-yellow-300 sm:text-sm/6">
                    </div>
                    @error('first_name')
                    <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="last_name" class="block text-sm/6 font-medium text-white">Last name</label>
                    <div class="mt-2">
                        <input type="text" name="last_name" id="last_name" autocomplete="last_name" required
                               value="{{ old('last_name') }}"
                               class="block w-full text-white rounded-md bg-laravel-black-900 p-3 text-base placeholder:text-laravel-gray-300 focus:outline-2 focus:outline-offset-2 focus:outline-laravel-yellow-300 sm:text-sm/6">
                    </div>
                    @error('last_name')
                    <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

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
                <label for="password" class="block text-sm/6 font-medium text-white">Password</label>
                <div class="mt-2">
                    <input type="password" name="password" id="password" autocomplete="new-password" required
                           class="block w-full text-white rounded-md bg-laravel-black-900 p-3 text-base placeholder:text-laravel-gray-300 focus:outline-2 focus:outline-offset-2 focus:outline-laravel-yellow-300 sm:text-sm/6">
                </div>
                @error('password')
                <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm/6 font-medium text-white">Password
                    confirmation</label>
                <div class="mt-2">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           autocomplete="new-password" required
                           class="block w-full text-white rounded-md bg-laravel-black-900 p-3 text-base placeholder:text-laravel-gray-300 focus:outline-2 focus:outline-offset-2 focus:outline-laravel-yellow-300 sm:text-sm/6">
                </div>
                @error('password_confirmation')
                <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-sm text-end">
                <a href="{{ route('forgotPassword') }}"
                   class="font-semibold text-laravel-yellow-300 hover:text-laravel-yellow-300/90">
                    Forgot password?
                </a>
            </div>

            <div>
                <button type="submit"
                        class="flex cursor-pointer w-full justify-center rounded-md bg-laravel-yellow-100 p-3 text-sm/6 font-semibold text-black shadow-xs hover:bg-laravel-yellow-100/90 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Sign up with email
                </button>
            </div>
        </form>

        @if(session('server_error'))
            <div class="flex justify-center items-center bg-red-400 text-white rounded-md py-3 px-2 mt-4">
                <p>{{ session('server_error') }}</p>
            </div>
        @endif

        <div class="relative flex my-8 items-center">
            <div class="flex-grow border-t border-laravel-gray-200"></div>
            <span class="flex-shrink mx-4 text-laravel-gray-300">Or login with</span>
            <div class="flex-grow border-t border-laravel-gray-200"></div>
        </div>

        <div class="grid sm:grid-cols-2 gap-4">
            <div
                class="flex border border-laravel-gray-200 w-full gap-x-4 items-center justify-center rounded-md py-3 px-12 cursor-pointer hover:bg-laravel-black-900 transition">
                <img src="{{ asset('assets/google.png') }}" alt="Google logo">
                <p class="text-lg text-white">Google</p>
            </div>

            <div
                class="flex border border-laravel-gray-200 w-full gap-x-4 items-center justify-center rounded-md py-3 px-12 cursor-pointer hover:bg-laravel-black-900 transition">
                <img src="{{ asset('assets/apple.png') }}" alt="Apple logo">
                <p class="text-lg text-white">Apple</p>
            </div>
        </div>

        <p class="mt-10 text-center text-sm/6 text-laravel-gray-300">
            Already have an account?
            <a href="{{ route('login') }}"
               class="font-semibold text-laravel-yellow-300 hover:text-laravel-yellow-300/90">Login now</a>
        </p>

    </div>
</x-layouts.auth-layout>
