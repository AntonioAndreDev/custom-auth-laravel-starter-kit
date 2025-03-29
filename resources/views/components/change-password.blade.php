<h2 class="text-2xl/9 font-bold tracking-tight text-white">Edit your password</h2>

<form class="space-y-4 mt-4" action="{{ route('profile.change_password') }}" method="POST" novalidate>
    @csrf

    <div>
        <label for="current_password" class="block text-sm/6 font-medium text-white">Current
            password</label>
        <div class="mt-2">
            <input type="password" name="current_password" id="current_password"
                   autocomplete="current-password"
                   class="block w-full text-white rounded-md bg-laravel-black-900 p-3 text-base placeholder:text-laravel-gray-300 focus:outline-2 focus:outline-offset-2 focus:outline-laravel-yellow-300 sm:text-sm/6">
        </div>
        @error('current_password')
        <p class="text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="new_password" class="block text-sm/6 font-medium text-white">New password</label>
        <div class="mt-2">
            <input type="password" name="new_password" id="new_password" autocomplete="new-password"
                   class="block w-full text-white rounded-md bg-laravel-black-900 p-3 text-base placeholder:text-laravel-gray-300 focus:outline-2 focus:outline-offset-2 focus:outline-laravel-yellow-300 sm:text-sm/6">
        </div>
        @error('new_password')
        <p class="text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="new_password_confirmation" class="block text-sm/6 font-medium text-white">New password
            confirmation</label>
        <div class="mt-2">
            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                   class="block w-full text-white rounded-md bg-laravel-black-900 p-3 text-base placeholder:text-laravel-gray-300 focus:outline-2 focus:outline-offset-2 focus:outline-laravel-yellow-300 sm:text-sm/6">
        </div>
        @error('new_password_confirmation')
        <p class="text-red-600">{{ $message }}</p>
        @enderror
    </div>

    @if (session('server_error'))
        <div class="bg-red-300 p-3 rounded-md">
            <p class="text-black text-center">{{ session('server_error') }}</p>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-green-300 p-3 rounded-md">
            <p class="text-black text-center">{{ session('success') }}</p>
        </div>
    @endif

    <div>
        <button type="submit"
                class="flex cursor-pointer w-full justify-center rounded-md bg-laravel-yellow-100 p-3 text-sm/6 font-semibold text-black shadow-xs hover:bg-laravel-yellow-100/90 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Edit password
        </button>
    </div>
</form>
