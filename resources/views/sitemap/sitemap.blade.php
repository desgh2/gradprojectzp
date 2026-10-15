<?php echo '<?xml version="1.0" encoding="UTF-8"?>';?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	@foreach (App\Models\Category::getPrimaryMenu() as $c)
	<url>
    	<loc>{{ url($c->slug) }}</loc>
    	<lastmod>{{ $c->updated_at->tz('GMT')->toAtomString() }}</lastmod>
  	</url>
	@if ($c->subcategories->isNotEmpty())
            @foreach ($c->subcategories as $item)
                <url>
                    <loc>{{ route('front.subcategory', ['parent' => $c->slug, 'category' => $item->slug]) }}</loc>
                    <lastmod>{{ $item->updated_at->tz('GMT')->toAtomString() }}</lastmod>
                </url>
            @endforeach
        @endif
	@endforeach
</urlset>
