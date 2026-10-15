<div>
    @include('breadcrumbs', [
        'breadcrumbs' => [
            'advert' => 'Розташування зовнішньої реклами',
        ],
    ])
    <div class="container">
        <div class="row">
            <!-- <div class="text-center mb-4"><a class="fw-bold" style="color:black"
                    href="{{ route('front.department', ['department' => 'yak-orenduvati-primishchennya']) }}">За
                    додатковою інформацією про оренду рекламних бордів звертайтесь за телефоном (067)-654-34-31</a>
            </div> -->
           
            <div class="col-12 mb-5">
                <div id="map" style="width: 100%; height: 500px" wire:ignore></div>
            </div>
            @if ($districts)
                <div class="category-sidebar col-12 col-lg-3">
                    <p class="fs-5 fw-bold pb-3 mb-3">Оберіть район</p>
                    <form class="mb-3">
                        <input type="text" wire:model.live="search" class="form-control input-field"
                            placeholder="Пошук...">
                    </form>
                    <ul class="category-nav">
                        <label class="list-group-item d-flex justify-content-between gap-2 w-100 mb-2">
                            <span class="d-block">
                                Всі райони
                            </span>
                            <input class="d-block form-check-input flex-shrink-0" type="radio" wire:model.live="area"
                                value="">
                        </label>
                        @foreach ($districts as $district)
                            <li>
                                <label class="list-group-item d-flex justify-content-between gap-2 w-100 mb-2">
                                    <span class="d-block ">{{ $district['name'] }}</span>
                                    <input class="d-block form-check-input flex-shrink-0" type="radio"
                                        wire:model.live="area" value="{{ $district['id'] }}">
                                </label>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div id="estate-category" class="category-main col-12 col-lg-8 offset-lg-1">
                    <h1 class="category-title">{{ $heading }}</h1>
                    <div class="row">
                        @if ($rows->isNotEmpty())
                            @foreach ($rows as $row)
                                <div class="real-estate-box d-block col-lg-12">
                                    <div class="cards row">
                                        <div class="col-12 col-lg-6">
                                            <img src="{{ asset('storage/advert/' . $row->id . '/poster/' . $row->poster) }}"
                                                class="my-0 w-100 card-img-top" alt="{{ $row->name }}">
                                        </div>
                                        <div class="col-12 col-lg-6 cards-body">
                                            <p class="card-text fw-bold fs-5">{{ $row->name }}</p>
                                            {!! $row->text !!}
                                            <a href="{{ route('front.advert.show', ['advert' => $row->slug]) }}"
                                                class="btn btn-primary text-white mt-2">Детальніше</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="pagination-box">
                                {{ $rows->onEachSide(0)->links(data: ['scrollTo' => '#estate-category']) }}
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.1.0/dist/geosearch.css" />
    <style>
        #map {
            width: 600px;
            height: 400px;
        }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('js/leaflet.js') }}"></script>

    <script>
        var locations = @json($all);
        var map = L.map('map').setView([47.817348, 35.105267], 12);
        mapLink =
            '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; ' + mapLink + ' Contributors',
                maxZoom: 18,
            }).addTo(map);

        for (var i = 0; i < locations.length; i++) {

            let location = 'https://gradproj.zp.ua/real-estate/' + locations[i]['slug'];
            let link = '<a href="' + location + '" target="_blank">' + locations[i]['name'] + '</a>';

            marker = new L.marker([locations[i]['lat'], locations[i]['lon']])
                .bindPopup(link)
                .addTo(map);
        }
    </script>
@endpush
