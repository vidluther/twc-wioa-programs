<x-layout>
<div>
    {{-- Do your work, then step back. --}}
    <h4
        class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300"
    >
    Showing Details of {{ $program->program_name }}
    </h4>

    <div
        class="w-full px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800"
    >
        <x-program.label> Name </x-program.label>
        <x-program.detail> {{ $program->program_name }}</x-program.detail>

        <x-program.label> Description </x-program.label>
        <x-program.detail> {{ $program->program_description }}</x-program.detail>

        <x-program.label> Program Website </x-program.label>
        <x-program.detail> <a href="https://{{ $program->program_url }}" target="new"> {{ $program->program_url }}</a></x-program.detail>

        <x-program.label> Cost </x-program.label>
        <x-program.detail> ${{ number_format($program->program_cost_tuition_and_fees,2) }}</x-program.detail>
        <x-program.label> Pell Eligible </x-program.label>
        <x-program.detail> {{ $program->program_pell_eligible }}</x-program.detail>

        <x-program.label> Length in Hours </x-program.label>
        <x-program.detail> {{ $program->program_length_hours }}</x-program.detail>

        <x-program.label> Length in Weeks </x-program.label>
        <x-program.detail> {{ $program->program_length_weeks }}</x-program.detail>

        <x-program.label> Outcome </x-program.label>
        <x-program.detail> {{ $program->program_outcome }}</x-program.detail>
        <x-program.label> Credential Earned </x-program.label>
        <x-program.detail> {{ $program->program_credential_name ?? 'None Provided' }}</x-program.detail>
        <x-program.label> Program Format </x-program.label>
        <x-program.detail> {{ $program->program_format }}</x-program.detail>

        <x-program.label> Provided By </x-program.label>
        <x-program.detail> {{ $program->provider_name }}</x-program.detail>
        <x-program.label> About {{ $program->provider_name }}</x-program.label>
        <x-program.detail> {{ $program->provider_description }}</x-program.detail>

        <x-program.label> Provider Type</x-program.label>
        <x-program.detail> {{ $program->provider_type }}</x-program.detail>

        <x-program.label> Address </x-program.label>
        <x-program.detail> {{ $program->provider_campus_addr1 }}
            {{ $program->provider_campus_addr2 }} <br />
            {{ $program->provider_campus_city }} {{ $program->provider_campus_state }}, {{ $program->provider_campus_zip }}
        </x-program.detail>

        <x-program.label> County</x-program.label>
        <x-program.detail> {{ ucfirst($program->provider_campus_county) }}</x-program.detail>

        <x-program.label> Day Care on Site? </x-program.label>
        <x-program.detail> {{ $program->onsite_childcare }}</x-program.detail>

        <x-program.label> Public Transport Available? </x-program.label>
        <x-program.detail> {{ $program->public_transit }}</x-program.detail>



</div>
<div>
    <a
        class="py-4 px-4 items-center justify-between p-4  text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
        href="/"
    > <span>Go Back &LeftArrow;</span>
    </a>
 <br />
</div>
</x-layout>
