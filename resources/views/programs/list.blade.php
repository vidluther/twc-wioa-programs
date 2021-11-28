 <!-- New Table -->
 <div class="px-4 py-4 w-full">  {{ $programs->links()  }}</div> 

 <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                >
                    <th class="px-1 py-1">Name</th>
                    <th class="px-1 py-1">Description </th>
                    <th class="px-1 py-1">City</th>
                    <th class="px-1 py-1">County</th>
                    <th class="px-1 py-1">Cost</th>
                    <th class="px-1 py-1">Weeks</th>
                    <th class="px-1 py-1"> Start Date</th>
                    <th class="px-1 py-1"> Last Updated </th>
                </tr>
                </thead>

                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @if ($programs->count() == 0)
                    <tr>
                        <td colspan="5">No programs to display.</td>
                    </tr>
                @endif
                @foreach ($programs AS $program)

                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-1 py-1">
                        <a href="/programs/{{ $program->program_twist_id }}" class="font-semibold">
                            {!! $program->program_name !!}
                        </a>
                    </td>
                    <td class="px-1 py-1">{{ $program->program_description }} </td>


                    <td class="px-2 py-3"> {{ $program->provider_campus_city }} </td>
                    <td class="px-2 py-3"> {{ $program->provider_campus_county }} </td>
                    <td class="px-2 py-3"> ${{ number_format((float) $program->program_cost_tuition_and_fees,2) }} </td>
                    <td class="px-2 py-3"> {{ $program->program_length_weeks }}</td>
                    <td class="px-1 py-1"> {{ strftime("%Y-%m-%d", (int) $program->program_start_date) }} </td>
                    <td class="px-1 py-1"> {{ strftime("%Y-%m-%d", (int) $program->program_last_updated)}} </td>
                </tr>

                @endforeach
                </tbody>
            </table>

            <div>  {{ $programs->links()  }}</div> 
