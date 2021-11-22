<x-layout>
    <h1> Details of Provider   </h1> <br />
    <h2 class="text-lg text-gray-500 dark:text-gray-400">  {{ $provider->name }}</h2>
    <h3> <a href="/providertypes/{{ $provider->provider_type->slug }}"> {{ $provider->provider_type->name }}</a></h3>
    <h4> {{ $provider->description }}</h4>

</x-layout>
<div class="py-4 text-gray-500 dark:text-gray-400">
    <a href="/providers" class="bg-blend-color-dodge">  Back to List of Providers </a>
</div>


