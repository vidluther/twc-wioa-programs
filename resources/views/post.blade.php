<x-layout> 
<h2> Posts Details </h2> 
        <article> 
            <h1> 
                <a href="/posts/{{ $post->id }}"> 
                    {{ $post->title }}
                </a>
</h1> 
    <div> 
       
    {{ $post->excerpt }}
</div> 
<div> 
    {{ $post->body }}
</article> 
</x-layout> 