<!doctype html>
<html lang="en" class="text-gray-900 leading-tight">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>{{ $title ?? 'TWC-WIOA Program List' }}</title>
    </head>
    <body class="min-h-screen bg-gray-100">
    <h1> TWC-WIOA Approved Program List </h1>
    
    </header>
        <hr/>
        {{ $slot }}
    </body>
</html>
