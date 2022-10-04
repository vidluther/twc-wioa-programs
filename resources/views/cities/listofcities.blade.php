<x-layouts.app>
<x-slot name="header">
    <h1 class="font-bold text-xl text-gray-800 leading-tight">
        {{ __('Eligible Training Providers in Texas by City') }}
    </h1>
</x-slot>




@forelse($cities AS $city)
        <span class="space-y-2 space-x-2"> &nbsp; </span>

        <p class="border-t space-y-4 prose">
            <a title="twc-wioa eligible training programs in {{ ucwords($city->provider_campus_city) }}" href="{{ route('list-by-city',Str::slug($city->provider_campus_city)) }}" class="underline">
                {{ ucwords($city->provider_campus_city) }}</a>
            has {{ $city->getNumberOfProgramsByCity($city->provider_campus_city); }} programs.
        </p>

@empty

@endforelse


{{--@foreach($grouped AS $city => $num)--}}
{{--        <a href="/{{ $city  }}" class="underline"> {{ ucwords($city) }} </a> has {{ $num }} programs <br />--}}
{{--@endforeach--}}


</x-layouts.app>
