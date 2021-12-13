<!doctype html>
<html lang="en">
    <head>
        {!! Meta::toHtml() !!}


        @livewireStyles
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <script src="{{ mix('/js/app.js') }}" defer></script>
    </head>

<body class="flex-col h-screen antialiased">


<x-leftnav />

<main role="main" class="w-full h-full flex-grow p-3 overflow-auto">
    <h1 class="text-2xl md:text-5xl mb-4 font-extrabold" id="home">Texas WFC-WIOA </h1>
{{ $slot }}
</main>
</div>


<x-footer />



@if(config('app.display_analytics_js') === true)
    <x-analytics> </x-analytics>
@endif


        @livewireScripts
    </body>
</html>
