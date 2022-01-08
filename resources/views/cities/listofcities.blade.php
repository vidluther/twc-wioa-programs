<x-layouts.app>
<x-slot name="header">
    <h1 class="font-bold text-xl text-gray-800 leading-tight">
        {{ __('Index of Programs by City') }}
    </h1>
</x-slot>
@foreach($grouped AS $city => $num)
        <a href="/in/{{ $city  }}" class="underline"> {{ ucwords($city) }} </a> has {{ $num }} programs <br />
@endforeach


</x-layouts.app>
