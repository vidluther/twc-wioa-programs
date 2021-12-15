<x-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of Eligible Training Providers and Programs in Texas') }}
        </h2>
    </x-slot>

    <div
        class="px-4 py-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
    >
        @if (!is_null($searched_for))
         <h4 class="py-4"> You Searched for {{ $searched_for }} </h4>
        @endif

        <form method="post" action="/"> @csrf
            <label for="search_for_city"> Search by City</label>
        <select name="search_for_city">
            @foreach ($cities AS $city)
                <option value="{{ $city->provider_campus_city }}"> {{ ucwords($city->provider_campus_city) }} </option>
            @endforeach
        </select>
            <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"> Search by city </button>
        </form>

        <form method="post" action="/">
        @csrf
        <label for="search_for_county"> Search by County </label>
        <select name="search_for_county"> Any
            @foreach ($counties AS $county)
                <option value="{{ $county->provider_campus_county }}"> {{ ucwords($county->provider_campus_county) }} </option>
            @endforeach
        </select>
            <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"> Search by County </button>
        </form>
    </div>

    @include('programs.list')

</div>
</x-layout>
