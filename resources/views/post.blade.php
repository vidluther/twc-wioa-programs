<x-layout>
<h2> Posts Details </h2>
        <article>
            <h1 class="capitalize">

                    {!! $post->title  !!}
            </h1>
            <div>

                    {{ $post->excerpt }}
            </div>
            <div>
            {!! $post->body !!}
            </div>
        </article>
    <div><br />
        <a href="/posts"> Back </a>
    </div>

</x-layout>
