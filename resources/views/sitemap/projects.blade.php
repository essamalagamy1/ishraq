{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
@foreach($projects as $project)
    <url>
        <loc>{{ $project['loc'] }}</loc>
        <lastmod>{{ $project['lastmod'] }}</lastmod>
        <changefreq>{{ $project['changefreq'] }}</changefreq>
        <priority>{{ $project['priority'] }}</priority>
        @foreach($project['images'] as $image)
        <image:image>
            <image:loc>{{ $image['loc'] }}</image:loc>
            <image:title>{{ $image['title'] }}</image:title>
            @if($image['caption'])
            <image:caption>{{ $image['caption'] }}</image:caption>
            @endif
        </image:image>
        @endforeach
    </url>
@endforeach
</urlset>
