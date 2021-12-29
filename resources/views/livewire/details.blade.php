{{--<x-slot name="header">--}}
{{--        <h1 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('') . $program->program_name }} class in {{ ucwords($program->provider_campus_city) . ", " . $program->provider_campus_state }}--}}
{{--        </h1>--}}
{{--</x-slot>--}}
<div>

<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ $program->program_name }} class in {{ ucwords($program->provider_campus_city) . ", " . $program->provider_campus_state }}
        </h1>
        <h2 class="mt-1 max-w-2xl text-sm text-gray-500">
           By {{ $program->provider_name }}
        </h2>
    </div>
</div>
<!-- schema.org stuff -->

{!! $schema !!}

<!-- / schema.org stuff -->
<div>


        <div class="border-t border-gray-200">
        <dl>
        <x-program.label class="bg-white"> Name </x-program.label>
        <x-program.detail> <span class="capitalize">  {{ $program->program_name }} </span> </x-program.detail>

        <x-program.label class="bg-gray-50 "> Description </x-program.label>
        <x-program.detail> {{ $program->program_description }}</x-program.detail>

        <x-program.label class="bg-white"> Program Website </x-program.label>
        <x-program.detail> <a class="underline" href="{{ $program->program_url }}" target="new"> {{ $program->program_url }}</a></x-program.detail>

        <x-program.label class="bg-gray-50 "> Cost </x-program.label>
        <x-program.detail> {{   $program->cost }} </x-program.detail>

        <x-program.label class="bg-white"> Pell Eligible </x-program.label>
        <x-program.detail> {{ $program->program_pell_eligible }}</x-program.detail>

        <x-program.label class="bg-gray-50 "> Length in Hours </x-program.label>
        <x-program.detail> {{ $program->program_length_hours }}</x-program.detail>

        <x-program.label class="bg-white"> Length in Weeks </x-program.label>
        <x-program.detail> {{ $program->program_length_weeks }}</x-program.detail>

        <x-program.label class="bg-gray-50 "> Outcome </x-program.label>
        <x-program.detail> {{ $program->program_outcome }}</x-program.detail>

        <x-program.label class="bg-white"> Credential Earned </x-program.label>
        <x-program.detail> {{ $program->program_credential_name ?? 'None Provided' }}</x-program.detail>

        <x-program.label class="bg-gray-50 "> Program Format </x-program.label>
        <x-program.detail> {{ $program->program_format }}</x-program.detail>

        <x-program.label class="bg-white"> Provided By </x-program.label>
        <x-program.detail> {{ $program->provider_name }}</x-program.detail>

        <x-program.label class="bg-gray-50 "> About {{ $program->provider_name }}</x-program.label>
        <x-program.detail> {{ $program->provider_description }}</x-program.detail>

        <x-program.label class="bg-white"> Provider Type</x-program.label>
        <x-program.detail> {{ $program->provider_type }}</x-program.detail>

        <x-program.label class="bg-gray-50 "> Address </x-program.label>
        <x-program.detail> {{ $program->provider_campus_addr1 }}
            {{ $program->provider_campus_addr2 }} <br />
            {{ ucwords($program->provider_campus_city) }} {{ $program->provider_campus_state }}, {{ $program->provider_campus_zip }}
        </x-program.detail>

        <x-program.label class="bg-white "> County</x-program.label>
        <x-program.detail> {{ ucwords($program->provider_campus_county) }}</x-program.detail>

        <x-program.label class="bg-gray-50 "> Day Care on Site? </x-program.label>
        <x-program.detail> {{ $program->onsite_childcare }}</x-program.detail>

        <x-program.label class="bg-white"> Public Transport Available? </x-program.label>
        <x-program.detail> {{ $program->public_transit }}</x-program.detail>



</div>

    @include('programs.nextsteps')

<div class="px-4 py-4 mb-8 bg-white rounded-lg">
<a
    class="items-center justify-between p-4 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
    href="/"
> Go Back
</a>

    <script>plausible("details",{ props: { title: document.title, path: document.location.pathname } });</script>
</div>

