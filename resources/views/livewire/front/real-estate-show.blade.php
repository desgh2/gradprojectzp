<div>
    @include('breadcrumbs', [
        'breadcrumbs' => [
            'real-estate' => 'Нерухоме майно',
            $estate->slug => $estate->name,
        ],
    ])
    <div class="container">
        <h1 class="page-title">{{ $estate->heading }}</h1>
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset("uploads/estate/{$estate->id}/{$estate->poster}") }}" class="w-100" alt="">
            </div>
            <div class="col-md-6">
                <div class="real-estate-text mb-4">{!! $estate->text !!}</div>
                @isset($estate->gallery)
                <hr>
                    <div class="row mt-5">
                        <div class="col-12 mb-3">Більше фото</div>
                        <div class="col-md-3">
                            <a class="estate-gallery" style="max-height: 108px; overflow: hidden; display: block;" href="{{ asset("uploads/estate/{$estate->id}/{$estate->poster}") }}" data-fancybox="images">
                                <img class="w-100" src="{{ asset("uploads/estate/{$estate->id}/{$estate->poster}") }}" alt="">
                            </a>
                        </div>
                        @foreach (json_decode($estate->gallery) as $k => $gallery)
                            <div class="col-md-3">
                                <a class="estate-gallery" style="max-height: 108px; overflow: hidden; display: block;" href="{{ asset("uploads/estate/{$estate->id}/gallery/{$gallery}") }}" data-fancybox="images" data-index="{{ $k }}">
                                    <img class="w-100" src="{{ asset("uploads/estate/{$estate->id}/gallery/{$gallery}") }}" alt="">
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endisset
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.4/jquery.fancybox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/estate-fancybox.js') }}"></script>
@endpush
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.4/jquery.fancybox.css" rel="stylesheet" />
@endpush
