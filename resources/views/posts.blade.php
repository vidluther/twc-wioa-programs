<x-layout>
<h2> Posts view </h2> <br />
    @foreach ($posts AS $post)
        <article>
            <h1>
                <a href="/posts/{{ $post->slug }}" class="capitalize caret-blue-700">
                    {!! $post->title !!}
                </a>
            </h1>
    <div>

        {{ $post->excerpt }}
    </div>
</article>
        <hr  class="content-center"> <br />
    @endforeach
</x-layout>
