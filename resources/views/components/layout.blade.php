<!doctype html>
<html lang="en">
    <head>
        {!! Meta::toHtml() !!}


        @livewireStyles
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <script src="{{ mix('/js/app.js') }}" defer></script>

    </head>
    <body class="antialiased font-sans">

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
