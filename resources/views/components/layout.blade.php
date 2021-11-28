<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
            rel="stylesheet"
        />

        @livewireStyles
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <script src="{{ mix('/js/app.js') }}" defer></script>
        <x-seo :pagetitle="$pagetitle"/>

    </head>
    <body class="antialiased">
   
<x-navbar />

<div class="container px-6 mx-auto grid">


        {{ $slot }}

@if(config('app.display_analytics_js') === true)
    <x-analytics> </x-analytics>
@endif

<x-footer /> 
        @livewireScripts
    </body>
</html>
