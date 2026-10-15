<div>
    @include('breadcrumbs', [
        'breadcrumbs' => [
            'advert' => 'Оренда рекламних бордів',
            $advert->slug => $advert->name,
        ],
    ])
    <div class="container">
        <h1 class="page-title">{{ $advert->title }}</h1>
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/advert/' . $advert->id . '/poster/' . $advert->poster) }}" class="w-100"
                    alt="">
            </div>
            <div class="col-md-6">
                <div class="real-estate-text pt-4 mb-4">{!! $advert->text !!}</div>
                @if ($advert->pasport)
                    <div class="mb-3">
                        <a href="{{ asset('storage/advert/' . $advert->id . '/pasport/' . $advert->pasport) }}"
                            target="_blank" class="fw-bolder">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-download" viewBox="0 0 16 16">
                                <path
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                <path
                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                            </svg>
                            <span class="ms-1">Договір</span>
                        </a>
                    </div>
                @endif

                @if ($advert->order)
                    <div class="mb-3">
                        <a href="{{ asset('storage/advert/' . $advert->id . '/order/' . $advert->order) }}"
                            target="_blank" class="fw-bolder">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-download" viewBox="0 0 16 16">
                                <path
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                <path
                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                            </svg>
                            <span class="ms-1">Дозвільний документ</span>
                        </a>
                    </div>
                @endif

                @if ($advert->additional)
                    <p class="fw-bolder mb-3">Додаткові документи</p>
                    @foreach (json_decode($advert->additional) as $k => $v)
                        <a href="{{ asset('storage/advert/' . $advert->id . '/additional/' . $v) }}" target="_blank"
                            class="fw-bolder me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-file-earmark-pdf" viewBox="0 0 16 16">
                                <path
                                    d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2M9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                                <path
                                    d="M4.603 14.087a.8.8 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.7 7.7 0 0 1 1.482-.645 20 20 0 0 0 1.062-2.227 7.3 7.3 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a11 11 0 0 0 .98 1.686 5.8 5.8 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.86.86 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.7 5.7 0 0 1-.911-.95 11.7 11.7 0 0 0-1.997.406 11.3 11.3 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.8.8 0 0 1-.58.029m1.379-1.901q-.25.115-.459.238c-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361q.016.032.026.044l.035-.012c.137-.056.355-.235.635-.572a8 8 0 0 0 .45-.606m1.64-1.33a13 13 0 0 1 1.01-.193 12 12 0 0 1-.51-.858 21 21 0 0 1-.5 1.05zm2.446.45q.226.245.435.41c.24.19.407.253.498.256a.1.1 0 0 0 .07-.015.3.3 0 0 0 .094-.125.44.44 0 0 0 .059-.2.1.1 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a4 4 0 0 0-.612-.053zM8.078 7.8a7 7 0 0 0 .2-.828q.046-.282.038-.465a.6.6 0 0 0-.032-.198.5.5 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822q.036.167.09.346z" />
                            </svg>
                        </a>
                    @endforeach
                @endif


                @isset($advert->gallery)
                    <hr>
                    <div class="row mt-5">
                        <div class="col-12 mb-3">Більше фото</div>
                        <div class="col-4 col-md-3">
                            <a class="estate-gallery" style="max-height: 108px; overflow: hidden; display: block;"
                                href="{{ asset('storage/advert/' . $advert->id . '/poster/' . $advert->poster) }}"
                                data-fancybox="images">
                                <img class="w-100"
                                    src="{{ asset('storage/advert/' . $advert->id . '/poster/' . $advert->poster) }}"
                                    alt="">
                            </a>
                        </div>
                        @foreach (json_decode($advert->gallery) as $k => $gallery)
                            <div class="col-4 col-md-3 mb-3">
                                <a class="estate-gallery" style="max-height: 108px; overflow: hidden; display: block;"
                                    href="{{ asset('storage/advert/' . $advert->id . '/gallery/' . $gallery) }}"
                                    data-fancybox="images" data-index="{{ $k }}">
                                    <img class="w-100"
                                        src="{{ asset('storage/advert/' . $advert->id . '/gallery/' . $gallery) }}"
                                        alt="">
                                </a>
                            </div>
                        @endforeach

                    </div>
                @endisset
                <div class="col-12 est-map my-3">
                    <div id="map" style="width: 100%; height: 300px" wire:ignore></div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.4/jquery.fancybox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/estate-fancybox.js') }}"></script>
    <script src="{{ asset('js/leaflet.js') }}"></script>

    <script>
        var lc = @json($advert);
        var map = L.map('map').setView([lc['lat'], lc['lon']], 12);
        mapLink =
            '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; ' + mapLink + ' Contributors',
                maxZoom: 18,
            }).addTo(map);
        marker = new L.marker([lc['lat'], lc['lon']])
            .addTo(map);
    </script>
@endpush
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.4/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.1.0/dist/geosearch.css" />
    <style>
        #map {
            width: 600px;
            height: 400px;
        }
    </style>
@endpush
