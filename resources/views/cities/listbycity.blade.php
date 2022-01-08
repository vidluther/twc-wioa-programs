<x-layouts.app>
    <x-slot name="header">
        <h1 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __("Eligible Training Providers in $city, TX") }}
        </h1>
    </x-slot>
    <div> {{ $programs->links() }}</div>

    @forelse($programs as $program)
        <a href="/details/{{ $program->twc_program_id }}" class="underline"> {{$program->program_name}} </a> <br />
    @empty
        Nothing found here.. is it even a city, or is this a typo?
    @endforelse
</x-layouts.app>
