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
                @isset($estate->gallery)
                    <div class="row mt-5">
                        <p class="fs-5 mb-3">Більше фото</p>
                        <div class="col-4 col-md-3">
                            <a class="estate-gallery" style="max-height: 108px; overflow: hidden; display: block;"
                                href="{{ asset("uploads/estate/{$estate->id}/{$estate->poster}") }}" data-fancybox="images">
                                <img class="w-100" src="{{ asset("uploads/estate/{$estate->id}/{$estate->poster}") }}"
                                    alt="">
                            </a>
                        </div>
                        @foreach (json_decode($estate->gallery) as $k => $gallery)
                            <div class="col-4 col-md-3 mb-3">
                                <a class="estate-gallery" style="max-height: 108px; overflow: hidden; display: block;"
                                    href="{{ asset("uploads/estate/{$estate->id}/gallery/{$gallery}") }}"
                                    data-fancybox="images" data-index="{{ $k }}">
                                    <img class="w-100" src="{{ asset("uploads/estate/{$estate->id}/gallery/{$gallery}") }}"
                                        alt="">
                                </a>
                            </div>
                        @endforeach

                    </div>
                @endisset
            </div>
            <div class="col-md-6">
                <p class="fs-5">Опис нерухомості</p>
                <div class="real-estate-text pt-4 mb-2">{!! $estate->text !!}</div>
                @if (file_exists(public_path() . '/uploads/estate/' . $estate->id . '/pasport/' . $estate->pasport))
                    <div>
                        <a href="{{ asset("uploads/estate/{$estate->id}/pasport/{$estate->pasport}") }}" target="_blank"
                            class="btn btn-sm btn-warning text-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-download" viewBox="0 0 16 16">
                                <path
                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                <path
                                    d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z" />
                            </svg>
                            <span class="ms-1">Переглянути технічний паспорт</span>
                        </a>
                    </div>
                @endif
                <div class="col-12 est-map my-5">
                    <div id="map" style="width: 100%; height: 300px" wire:ignore></div>
                </div>
                @if ($show_message)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>Ваша заявка прийнята. Ми звяжемося з Вами якомога швидше.</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <form wire:submit="send" class="my-3 p-3 border" style="background-color: #f8f9fa">
                    <p class="text-center fs-5 mb-3">Залишити заявку на оренду</p>
                    <div class="row">
                        <small class="feedback-text-required mb-3">
                            <span class="text-warning">*</span> <span class="text-secondary"> - поля, обов’язкові для заповнення</span>
                        </small>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    placeholder="Ваше ім'я" wire:model.live="callback_name" required minlength="3" maxlength="30">
                                <label for="name">Ваше ім'я <span class="text-warning">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    placeholder="Ваш телефон" wire:model.live="callback_phone" required minlength="3" maxlength="30">
                                <label for="phone">Ваш телефон <span class="text-warning">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3 text-center">
                            <button type="submit" class="btn btn-dark">Відправити</button>
                        </div>
                    </div>
                </form>

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
        var lc = @json($estate);
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
