<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
            rel="stylesheet"
        />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}" defer></script>


        <title>{{ $title ?? 'TWC-WIOA Program List' }}</title>
    </head>
    <body>

    <div
        class="flex h-screen bg-gray-50 dark:bg-gray-900"
        :class="{ 'overflow-hidden': isSideMenuOpen }"
    >

<x-navbar>
<!-- this doesn't feel right.. but it should be loading the navbar component -->
</x-navbar>
        <main class="h-full pb-16 overflow-y-auto">

        {{ $slot }}




    </body>
</html>