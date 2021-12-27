<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{url('about')}}</loc>
        <lastmod>2021-12-19T05:45:04Z</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    @foreach ($programs as $post)
        <url>
            <loc>{{url('/show/' .$post->program_twist_id)}}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($post->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>
