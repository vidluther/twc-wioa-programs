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
                    <th class="px-4 py-3">Name</th>
                    <th class="px-3 py-3">Description </th>
                    <th class="px-4 py-3">Outcome</th>
                    <th class="px-2 py-3">Cost</th>
                    <th class="px-1 py-3">Hours</th>
                    <th class="px-1 py-3">Weeks</th>
                </tr>
                </thead>

                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($programs AS $program)


                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                        <a href="/programs/{{ $program->twc_id }}" class="font-semibold">
                            {!! $program->name !!}
                        </a>
                    </td>
                    <td class="px-3 py-3">{{ $program->description }} </td>


                    <td> {!! $program->outcome !!} </td>
                    <td class="px-2 py-3 text-xs"> ${{ $program->req_cost }}</a></td>
                    <td class="px-2 py-3 text-xs"> {{ $program->length_hours }}</a></td>
                    <td class="px-2 py-3 text-xs"> {{ $program->length_weeks }}</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
</x-layout-no-intro>
