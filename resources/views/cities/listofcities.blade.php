<x-layouts.app>
<x-slot name="header">
    <h1 class="font-bold text-xl text-gray-800 leading-tight">
        {{ __('Index of Programs by City') }}
    </h1>
</x-slot>

@forelse($cities AS $city)
    <a href="{{ route('list-by-city',Str::slug($city->provider_campus_city)) }}" class="underline"> {{ ucwords($city->provider_campus_city) }} </a>has {{ $city->getNumberOfProgramsByCity($city->provider_campus_city); }} programs <br />

@empty

@endforelse
{{--@foreach($grouped AS $city => $num)--}}
{{--        <a href="/{{ $city  }}" class="underline"> {{ ucwords($city) }} </a> has {{ $num }} programs <br />--}}
{{--@endforeach--}}


</x-layouts.app>
