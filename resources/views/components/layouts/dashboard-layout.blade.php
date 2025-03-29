<!doctype html>
<html lang="en" class="h-full bg-laravel-black-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $pageTitle  }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:100,200,300400,500,600,700,800,900"
          rel="stylesheet"/>


    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/fontawesome/all.min.js'])
</head>
<body class="h-full">

<div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-laravel-black-900 px-6">
        <div class="flex h-16 items-center justify-between">
            <p class="text-white">
                Olá, {{ Auth::user()->first_name }}
            </p>
            <a href="{{ route('logout') }}">
                <i class="fa-solid fa-right-from-bracket text-red-500 h-6 w-6"></i>
            </a>
        </div>

        <x-dashboard-nav/>

        <a href="{{ route('profile') }}"
           class="text-white hover:bg-laravel-yellow-100/90 hover:text-white group flex items-center gap-x-3 rounded-md py-3 px-2 w-full text-sm font-semibold mb-4">
            <i class="fa-solid fa-gear text-laravel-yellow-100 group-hover:text-white h-6 w-6"></i>
            Settings
        </a>
    </div>
</div>


<main class="py-10 lg:pl-72 text-white">
    <div class="px-4 sm:px-6 lg:px-8">
        {{ $slot }}
    </div>
</main>

</body>
</html>
