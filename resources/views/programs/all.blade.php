<x-layout-no-intro>
    <h2> List of All Programs  </h2> <br />

    <!-- New Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                >
                    <th class="px-1 py-1">Name</th>
                    <th class="px-1 py-1">Description </th>
                    <th class="px-1 py-1">Outcome</th>
                    <th class="px-1 py-1">Cost</th>
                    <th class="px-1 py-1">Hours</th>
                    <th class="px-1 py-1">Weeks</th>
                </tr>
                </thead>

                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($programs AS $program)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-1 py-1">
                        <a href="/programs/{{ $program->twc_id }}" class="font-semibold">
                            {!! $program->program_name !!}
                        </a>
                    </td>
                    <td class="px-1 py-1">{{ $program->program_description }} </td>


                    <td> {!! $program->program_outcome !!} </td>
                    <td class="px-2 py-3 text-xs"> ${{ $program->program_cost_tuition_and_fees }}</a></td>
                    <td class="px-2 py-3 text-xs"> {{ $program->program_length_hours }}</a></td>
                    <td class="px-2 py-3 text-xs"> {{ $program->program_length_weeks }}</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
</x-layout-no-intro>
