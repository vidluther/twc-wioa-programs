<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="https://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{url('about')}}</loc>
        <lastmod>2021-12-19T05:45:04Z</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{url('privacy-policy')}}</loc>
        <lastmod>2021-12-19T05:45:04Z</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('list-of-cities') }} </loc>
        <lastmod>2021-12-19T05:45:04Z</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

    @foreach ($programs as $program)
        <url>
            <loc>{{ route('program-details', $program->program_slug) }}</loc>
            <lastmod>{{ gmdate('Y-m-d\TH:i:s\Z',strtotime($program->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>
