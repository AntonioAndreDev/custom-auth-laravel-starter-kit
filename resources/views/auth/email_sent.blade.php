<x-layouts.auth-layout pageTitle="Login">
    <div class="bg-white w-1/4 mx-auto p-6 rounded-2xl shadow-xl space-y-4">
        <h2 class="text-center text-2xl/9 font-bold tracking-tight text-gray-900">
            An email has been sent to you with a link to confirm your registration.
        </h2>

        <p>
            An email to confirm your registration has been sent to <strong>{{ $email }}</strong>. Please check your
            inbox and click on
            the link to confirm your registration.
        </p>

        <p>
            If you did not request registration, please ignore this email.
        </p>

        <div>
            <a href="{{ route('login') }}">
                <button type="button"
                        class="flex cursor-pointer w-full justify-center rounded-md bg-[#dee33e] p-3 text-sm/6 font-semibold text-black shadow-xs hover:bg-[#dee33e]/90 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Return to login
                </button>
            </a>
        </div>
    </div>
</x-layouts.auth-layout>
