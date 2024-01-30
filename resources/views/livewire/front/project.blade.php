<div>
    @include('breadcrumbs', [
        'breadcrumbs' => [
            'projects' => 'Проєкти',
            $project->slug => $project->name,
        ],
    ])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="project-box">
                    <img src="{{ asset("uploads/projects/{$project->id}/{$project->poster}") }}" class="w-100 h-50"
                        alt="">
                    <div class="project-box-title">
                        <h1>{{ $project->name }}</h1>
                        <p>ресторан м.Запоріжжя</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="project-box-text">
                    {!! $project->text !!}
                </div>
            </div>
            @isset($project->gallery)
                <div class="col-12 my-5">
                    <div class="owl-carousel owl-theme">
                        @foreach (json_decode($project->gallery) as $k => $gallery)
                            <a href="{{ asset("uploads/projects/{$project->id}/gallery/{$gallery}") }}"
                                data-fancybox="images" data-index="{{ $k }}">
                                <img class="owl-lazy"
                                    data-src="{{ asset("uploads/projects/{$project->id}/gallery/{$gallery}") }}"
                                    alt="">
                            </a>
                        @endforeach
                    </div>
                </div>
            @endisset
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.4/jquery.fancybox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            center: false,
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
