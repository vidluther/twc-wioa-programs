<x-layout>
    <h2> <a href="/providers"> List of All Providers  </a></h2> <br />

    <p> List of <strong> {{ $providertypename }} </strong> Providers </h3>
    <!-- New Table -->
    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                >
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Url</th>
                    <th class="px-4 py-3">Description</th>
                    <th class="px-2 py-3">Provider Type</th>
                    <th class="px-4 py-3">Date Added</th>
                    <th> Actions </th>
                </tr>
                </thead>

                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
    @foreach ($providers AS $provider)


        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3">
                <a href="/providers/{{ $provider->twc_id }}" class="font-semibold">
                        {!! $provider->name !!}
                </a>
            </td>
            <td>{{ $provider->url }} </td>


            <td> {!! $provider->description !!} </td>
            <td class="px-2 py-3 text-xs"> <a href="/providertypes/{{ $provider->provider_type->slug }}"> {{ $provider->provider_type->name }}</a></td>
            <td> {{ date_format($provider->created_at, "Y-m-d h:i:s T") }}</td>
            <td> Edit , Delete etc. </td>
        </tr>
    @endforeach
                </tbody>
            </table>
</x-layout>
