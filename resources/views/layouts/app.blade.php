<!doctype html>
<html lang="en" data-theme="corporate">
<head>
    {{-- https://github.com/butschster/LaravelMetaTags  --}}
    {!! Meta::toHtml() !!}
    <link rel="canonical" href="{{ url()->current() }}" />

    <!-- Optimization trick.. as suggested here https://web.dev/defer-non-critical-css/ -->
    <!-- this gets rid of the "blocking requests" flag in speed tests -->
    <link rel="preload" href="{{ asset('css/app.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript> <link href="{{ asset('css/app.css') }}" rel="stylesheet"> </noscript>
    <!-- / Optimization trick -->

    <script src="{{ mix('/js/app.js') }}" defer></script>
    <!-- Analytics Code goes here -->
    @if(config('app.display_analytics_js') === true)
        <x-analytics> </x-analytics>
    @endif
<!-- / Analytics Code -->
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
</div>

@livewireScripts
<x-footer />


</body>
</html>
