<!doctype html>
<html lang="en" data-theme="corporate">
<head>
    {{-- https://github.com/butschster/LaravelMetaTags  --}}
    {!! Meta::toHtml() !!}
    <link rel="canonical" href="{{ url()->current() }}" />

    <link rel="preload" href="{{ asset('css/app.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <!-- Optimization trick.. as suggested here https://web.dev/defer-non-critical-css/ -->
    <noscript> <link href="{{ asset('css/app.css') }}" rel="stylesheet"> </noscript>
    <script src="{{ mix('/js/app.js') }}" defer></script>
    @livewireStyles

</head>
<body class="flex-col h-screen antialiased bg-white-200">
<!-- do the left navigation -->
<x-leftnav />
<!-- done with left navigation -->
<main role="main" class="w-full h-full flex-grow p-3 overflow-auto">
<!-- Page Header -->
@if (isset($header))
    {{ $header ?? 'List of Eligible Training Providers and Programs'}}
@endif
<!-- /Page Header -->



    {{ $slot }}

</main>

@if(config('app.display_analytics_js') === true)
    <x-analytics> </x-analytics>
@endif
@livewireScripts


</body>
</html>
