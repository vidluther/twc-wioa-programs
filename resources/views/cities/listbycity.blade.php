<x-layouts.app>
    <x-slot name="header">
        <h1 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __("Eligible Training Providers in $city, TX") }}
        </h1>
    </x-slot>
    <div> {{ $programs->links() }}</div>

    <!-- Programs Table -->
    <div class="w-full md:flex-col space-y-4">
        <x-table>
            <x-slot name="head">
                <x-table.heading class="w-1/3">Program Name</x-table.heading>
                <x-table.heading class="w-auto"> Description</x-table.heading>
                <x-table.heading> Provider </x-table.heading>
                <x-table.heading >Campus</x-table.heading>
                <x-table.heading >Cost</x-table.heading>

                <x-table.heading />
            </x-slot>
            <x-slot name="body">
            @forelse($programs as $program)
                    <x-table.row wire:loading.class.delay="opacity-50" wire:key="row-{{ $program->_id }}">
                        <x-table.cell>
                            <span href="#" class="inline-flex space-x-2 truncate text-sm leading-5">

                                <p class="text-cool-gray-600 truncate">
                                    <a href="{{ route('program-details' , $program->program_slug ) }}"> {{ $program->program_name }} </a>
                                </p>
                            </span>
                        </x-table.cell>
                        <x-table.cell>
                            <span class="text-cool-gray-900">{{ $program->program_description }} </span>
                        </x-table.cell>
                        <x-table.cell>
                            <span class="text-cool-gray-900">{{ $program->provider_name }} </span>
                        </x-table.cell>
                        <x-table.cell>
                            {{ ucwords($program->provider_campus_name) }}
                        </x-table.cell>
                        <x-table.cell>
                            <span class="text-cool-gray-900">${{ number_format((float) $program->program_cost_tuition_and_fees,2) }} </span>
                        </x-table.cell>


                    </x-table.row>

    @empty
        Nothing found here.. is it even a city, or is this a typo?
    @endforelse


    </x-slot>

</x-table>
</x-layouts.app>
