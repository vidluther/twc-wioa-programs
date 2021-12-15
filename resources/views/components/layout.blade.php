<!doctype html>
<html lang="en">
    <head>
        {{-- https://github.com/butschster/LaravelMetaTags  --}}
        {!! Meta::toHtml() !!}



        <meta property="og:url" content="{{ url()->current() }}" />

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <script src="{{ mix('/js/app.js') }}" defer></script>

        <link rel="canonical" href="{{ url()->current() }}" />

        @livewireStyles

    </head>

<body class="flex-col h-screen antialiased">


<x-leftnav />

<main role="main" class="w-full h-full flex-grow p-3 overflow-auto">
    <!-- Page Header -->
    @if (isset($header))
        {{ $header ?? 'List of Eligible Training Providers and Programs'}}
    @endif
    <!-- /Page Header -->
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
