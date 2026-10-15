<?php echo '<?xml version="1.0" encoding="UTF-8"?>';?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	@foreach (App\Models\Category::all() as $c)
	<url>
    	<loc>{{ url($c->slug) }}</loc>
    	<lastmod>{{ $c->updated_at->tz('GMT')->toAtomString() }}</lastmod>
  	</url>
	@endforeach
</urlset>
