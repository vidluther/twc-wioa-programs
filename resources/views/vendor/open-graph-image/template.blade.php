<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'Noto Sans', 'sans-serif', 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white w-[1200px] h-[630px] text-gray-800 p-12 border-gray-200 border-[16px] shadow-lg">
        <h1 class="font-semibold text-[60px] leading-tight">{!! explode(' - ', $title)[0] !!}</h1>
        @if(isset($subtitle))
            <h2 class="mt-6 text-[30px] font-semibold uppercase text-gray-600">{{ $subtitle }}</h2>
        @endif
        @if (isset($button))
            <div class="inline-block px-6 py-3 mt-10 text-[30px] font-bold text-white rounded-lg bg-blue-600 hover:bg-blue-700 transition duration-300">
                {{ $button }}
            </div>
        @endif
    </div>
</body>
</html>