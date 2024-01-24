<div>
    @include('breadcrumbs', [
        'breadcrumbs' => [
            'news' => 'Новини',
            $post->slug => $post->name,
        ],
    ])
    <div class="container">
        <h1 class="new-title">{{ $post->heading }}</h1>
        <div class="new-text">{!! $post->text !!}</div>
        @if ($post->gallery)
            <div class="row my-5">
                <div class="col-lg-10 offset-lg-1">
                    <div class="owl-carousel owl-theme">
                        @foreach (json_decode($post->gallery) as $gallery)
                            <div>
                                <img src="{{ asset("uploads/news/{$post->id}/gallery/{$gallery}") }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <div class="text-md-end new-published">Опубліковано:
            {{ \Carbon\Carbon::parse($post->created_at)->format('d.m.Y h:i') }}
            @if ($post->created_at != $post->updated_at)
            (оновлено: {{ \Carbon\Carbon::parse($post->updated_at)->format('d.m.Y h:i') }})
            @endif
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>
@endpush
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
@endpush
