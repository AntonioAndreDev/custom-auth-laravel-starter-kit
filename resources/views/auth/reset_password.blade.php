<x-layouts.auth-layout pageTitle="Recuperação de senha">
    <div class="bg-laravel-black-100 lg:w-1/2 lg:mx-auto sm:p-6 p-4 rounded-2xl shadow-xl">
        <h2 class="text-center text-2xl font-bold tracking-tight text-white">Create your new password</h2>

        <form class="space-y-4 mt-4" action="{{ route('resetPasswordUpdate') }}" method="POST" novalidate>
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label for="new_password" class="block text-sm font-medium text-white">New Password</label>
                <div class="mt-2">
                    <input type="password" name="new_password" id="new_password" required
                           class="block w-full text-white rounded-md bg-laravel-black-900 p-3 text-base placeholder:text-laravel-gray-300 focus:outline-2 focus:outline-offset-2 focus:outline-laravel-yellow-300 sm:text-sm">
                </div>
                @error('new_password')
                <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="new_password_confirmation" class="block text-sm font-medium text-white">Confirm
                    new Password
                </label>
                <div class="mt-2">
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                           class="block w-full text-white rounded-md bg-laravel-black-900 p-3 text-base placeholder:text-laravel-gray-300 focus:outline-2 focus:outline-offset-2 focus:outline-laravel-yellow-300 sm:text-sm">
                </div>
                @error('new_password_confirmation')
                <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-sm text-end">
                <a href="{{ route('login') }}"
                   class="font-semibold text-laravel-yellow-300 hover:text-laravel-yellow-300/90">
                    Remembered your password? Sign in
                </a>
            </div>

            <div>
                <button type="submit"
                        class="flex cursor-pointer w-full justify-center rounded-md bg-laravel-yellow-100 p-3 text-sm font-semibold text-black shadow-xs hover:bg-laravel-yellow-100/90 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Set new password
                </button>
            </div>
        </form>

        @if(session('server_message'))
            <div class="flex justify-center items-center bg-yellow-500 text-black rounded-md py-3 px-2 mt-4">
                <p>
                    {{ session('server_message') }}
                </p>
            </div>
        @endif

        <div class="relative flex my-4 items-center">
            <div class="flex-grow border-t border-laravel-gray-200"></div>
            <span class="flex-shrink mx-4 text-laravel-gray-300">Or</span>
            <div class="flex-grow border-t border-laravel-gray-200"></div>
        </div>

        <p class="text-center text-sm text-laravel-gray-300">
            Don’t have an account?
            <a href="{{ route('register') }}"
               class="font-semibold text-laravel-yellow-300 hover:text-laravel-yellow-300/90">Get
                Started</a>
        </p>
    </div>
</x-layouts.auth-layout>
