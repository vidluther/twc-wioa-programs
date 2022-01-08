<x-layouts.app>
    <x-slot name="header">
        <h1 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __("Eligible Training Providers in $city, TX") }}
        </h1>
    </x-slot>
    <div> {{ $programs->links() }}</div>

    @foreach($programs as $program)
        {{$program->program_name}} <br />
    @endforeach
</x-layouts.app>
