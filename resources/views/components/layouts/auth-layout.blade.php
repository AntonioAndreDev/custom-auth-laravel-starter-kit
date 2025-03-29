<!doctype html>
<html lang="en" class="h-full bg-laravel-black-900">
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


<main class="flex min-h-full flex-col justify-center px-4 py-12 lg:px-8 gap-y-8">
    <div>
        <img class="mx-auto h-14 w-auto"
             src="{{ asset('assets/logo.png') }}" alt="Company">
        <h1 class="text-2xl font-semibold mt-4 text-center">Lorem Ipsum</h1>
    </div>

    {{ $slot }}
</main>


</body>
</html>
