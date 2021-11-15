<x-layout> 
<h2> Posts view </h2> 
    @foreach ($posts AS $post) 
        <article> 
            <h1> 
                <a href="/posts/{{ $post->id }}"> 
                    {{ $post->title }}
                </a>
</h1> 
    <div> 
       
    {{ $post->excerpt }}
</div> 
</article> 
    @endforeach
</x-layout> 