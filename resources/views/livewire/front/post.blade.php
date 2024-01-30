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

        @isset($post->gallery)
            <div class="row my-5">
                <div class="col-lg-10 offset-lg-1">
                    <div class="owl-carousel owl-theme">
                        @foreach (json_decode($post->gallery) as $k => $gallery)
                            <a href="{{ asset("uploads/news/{$post->id}/gallery/{$gallery}") }}" data-fancybox="images"
                                data-index="{{ $k }}">
                                <img class="owl-lazy" data-src="{{ asset("uploads/news/{$post->id}/gallery/{$gallery}") }}"
                                    alt="">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endisset
        <div class="text-md-end new-published">Опубліковано:
            {{ \Carbon\Carbon::parse($post->created_at)->format('d.m.Y h:i') }}
            @if ($post->created_at != $post->updated_at)
                (оновлено: {{ \Carbon\Carbon::parse($post->updated_at)->format('d.m.Y h:i') }})
            @endif
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.4/jquery.fancybox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            center: true,
            items: 3,
            loop: true,
            pagination: false,
            slideSpeed: 700,
            paginationSpeed: 700,
            rewindSpeed: 700,
            lazyLoad: true,
            dots: false,
            nav: true,
            navText: ["<i class='bi bi-chevron-left'></i>", "<i class='bi bi-chevron-right'></i>"]
        });
        $().fancybox({
            selector: '.owl-item:not(.cloned) a',
            backFocus: false,
            hash: false,
            thumbs: {
                autoStart: true
            },
            buttons: [
                'zoom',
                'download',
                'close'
            ]
        });
        $(document).on('click', '.owl-item.cloned a', function(e) {
            var $slides = $(this)
                .parent()
                .siblings('.owl-item:not(.cloned)');

            $slides
                .eq(($(this).attr("data-index") || 0) % $slides.length)
                .find('a')
                .trigger("click.fb-start", {
                    $trigger: $(this)
                });

            return false;
        });
    </script>
@endpush
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.4/jquery.fancybox.css" rel="stylesheet" />
@endpush
