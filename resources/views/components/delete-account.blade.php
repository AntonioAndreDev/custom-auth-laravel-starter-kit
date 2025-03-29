<h2 class="text-2xl/9 font-bold tracking-tight text-white">Delete your account</h2>
<p class="text-laravel-gray-300">
    If you want to delete your account, type DELETE MY ACCOUNT in the field below and click on the button.
</p>

<form class="space-y-4 mt-4" action="{{ route('deleteAccount') }}" method="POST" novalidate>
    @csrf

    <div>
        <label for="delete_account_confirmation" class="block text-sm/6 font-medium text-white">
            Delete account confirmation
        </label>
        <div class="mt-2">
            <input type="text" name="delete_account_confirmation" id="delete_account_confirmation"
                   class="block w-full text-white rounded-md bg-laravel-black-900 p-3 text-base placeholder:text-laravel-gray-300 focus:outline-2 focus:outline-offset-2 focus:outline-laravel-yellow-300 sm:text-sm/6">
        </div>
        @error('delete_account_confirmation')
        <p class="text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <button type="submit"
                class="flex cursor-pointer w-full justify-center rounded-md bg-red-600 p-3 text-sm/6 font-semibold text-white shadow-xs hover:bg-red-600/90 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            Delete account
        </button>
    </div>
</form>
