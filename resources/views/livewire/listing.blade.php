<x-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of Eligible Training Providers and Programs in Texas') }}
        </h1>
    </x-slot>

    <div
        class="px-4 py-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
    >
        @if (!is_null($searched_for))
         <h4 class="py-4"> You Searched for {{ $searched_for }} </h4>
        @endif




    </div>

    @include('programs.list')

</div>
</x-layout>
