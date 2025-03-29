<x-layouts.auth-layout pageTitle="Email verificado com sucesso">
    <div class="bg-white w-1/4 mx-auto p-6 rounded-2xl shadow-xl space-y-4">
        <h2 class="text-center text-2xl/9 font-bold tracking-tight text-gray-900">
            Your email has been verified successfully
        </h2>

        <p>
            Welcome, <strong>{{ Auth::user()->first_name }}</strong>
        </p>

        <div>
            <a href="{{ route('dashboard') }}"
               class="flex cursor-pointer w-full justify-center rounded-md bg-[#dee33e] p-3 text-sm/6 font-semibold text-black shadow-xs hover:bg-[#dee33e]/90 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Go to dashboard
            </a>
        </div>

    </div>

</x-layouts.auth-layout>

