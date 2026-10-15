<?php echo '<?xml version="1.0" encoding="UTF-8"?>';?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
	@php
        $photos = App\Models\Photo::with('category')->get();
	@endphp
	@foreach ($photos as $p)
  	<url>
    	<loc>{{ url($p->category->slug.'/'.$p->id.'-'.$p->slug) }}</loc>
    	<image:image>
      		<image:loc>{{ asset('uploads/photos/'.$p->filename) }}</image:loc>
    	</image:image>
  	</url>
  	@endforeach
</urlset>
