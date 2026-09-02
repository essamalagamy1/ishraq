@php echo '<' . '?xml version="1.0" encoding="UTF-8"?' . '>'; @endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
@foreach($articles as $article)
    <url>
        <loc>{{ $article['loc'] }}</loc>
        <lastmod>{{ $article['lastmod'] }}</lastmod>
        <changefreq>{{ $article['changefreq'] }}</changefreq>
        <priority>{{ $article['priority'] }}</priority>
        @foreach($article['images'] as $image)
        <image:image>
            <image:loc>{{ $image['loc'] }}</image:loc>
            <image:title>{{ $image['title'] }}</image:title>
            @if(!empty($image['caption']))
            <image:caption>{{ $image['caption'] }}</image:caption>
            @endif
        </image:image>
        @endforeach
    </url>
@endforeach
</urlset>
