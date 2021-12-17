<x-slot name="header">
        <h1 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('List of Eligible Training Providers and Programs in Texas') }}
        </h1>
</x-slot>

<div class="py-4 space-y-4">
    <!-- Top Bar -->
    <div class="flex justify-between">
        <div class="w-2/3 flex space-x-4">
            <x-input.text wire:model="search" placeholder="Search for a class by name..."
                  class="bg-gray-100 border-1 rounded-md pl-8 pr-2 text-sm text-gray-700"/> &nbsp;
{{--            <x-input.select wire:model="search_city" id="search_city">--}}
{{--                @foreach ($cities AS $city)--}}
{{--                    <option value="{{ $city->provider_campus_city }}"> {{ ucwords($city->provider_campus_city) }} </option>--}}
{{--                @endforeach--}}
{{--            </x-input.select>--}}


        </div>

    </div>
    <div class="space-x-2">
        @if ($search)
            Looking for classes that match <strong> {{ $search }} </strong>
        @endif

        @if ($search_city)
            searching in {{ $search_city }}
        @endif
    </div>

    <div class="py-4 space-y-4">
        {{ $programs->links() }}
    </div>

    <!-- Programs Table -->
    <div class="flex-col space-y-4">
        <x-table>
            <x-slot name="head">
                <x-table.heading class="w-1/3">Name</x-table.heading>
                <x-table.heading class="w-auto"> Description</x-table.heading>
                <x-table.heading >City</x-table.heading>
                <x-table.heading >Cost</x-table.heading>

                <x-table.heading />
            </x-slot>
            <x-slot name="body">
                @forelse ($programs as $program)
                    <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $program->_id }}">
                        <x-table.cell>
                            <span href="#" class="inline-flex space-x-2 truncate text-sm leading-5">


                                <p class="text-cool-gray-600 truncate">
                                    <a href="/show/{{ $program->program_twist_id }}"> {{ $program->program_name }} </a>
                                </p>
                            </span>
                        </x-table.cell>
                        <x-table.cell>
                            <span class="text-cool-gray-900 font-medium">{{ $program->program_description }} </span>
                        </x-table.cell>
                        <x-table.cell>
                            {{ ucwords($program->provider_campus_city) }}
                        </x-table.cell>
                        <x-table.cell>
                            <span class="text-cool-gray-900 font-medium">${{ number_format((float) $program->program_cost_tuition_and_fees,2) }} </span>
                        </x-table.cell>


                    </x-table.row>
                @empty
                    <x-table.row>
                        <x-table.cell colspan="6">
                            <div class="flex justify-center items-center space-x-2">
                                <x-icon.inbox class="h-8 w-8 text-cool-gray-400" />
                                <span class="font-medium py-8 text-cool-gray-400 text-xl">No programs found...</span>
                            </div>
                        </x-table.cell>
                    </x-table.row>
                @endforelse
            </x-slot>

        </x-table>

        <div>
            {{ $programs->links() }}
        </div>

  </div>
