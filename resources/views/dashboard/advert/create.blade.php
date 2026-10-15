@extends('layouts.master')
@section('title', 'Додати запис')
@section('content')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title">@yield('title')</h1>
        </div>
    </div>
    @if ($errors->any())
        <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration border-5 border-danger border-top-0 border-end-0 border-bottom-0"
            role="alert">
            <div class="inner">
                <div class="app-card-body p-3 p-lg-4">
                    <h3 class="mb-3">Помилка</h3>
                    <div class="row gx-5 gy-3">
                        <div class="col-12 col-lg-9">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><!--//col-->
                    </div><!--//row-->
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div><!--//app-card-body-->
            </div><!--//inner-->
        </div>
    @endif
    <hr class="mb-4">
    <form action="{{ route('advert.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4 settings-section">
            <div class="col-12">
                <div class="section-intro">Поля позначені <span class="text-danger">*</span> - обов`язкові для заповнення
                </div>
            </div>
            <div class="col-12 col-md-9">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">
                        <div class="settings-form">
                            <div class="mb-4">
                                <label for="district_id" class="form-label">Оберіть район <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" name="district_id" id="district_id">
                                    <option value="">Оберіть район</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district['id'] }}" @selected(old('district_id') == $district['id'])>
                                            {{ $district['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="name" class="form-label">Назва <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" onkeyup="slugify('name', 'slug')" name="name"
                                    id="name" value="{{ old('name') }}">
                            </div>
                            <div class="mb-4">
                                <label for="slug" class="form-label">URL <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="slug" id="slug"
                                    value="{{ old('slug') }}">
                            </div>
                            <div class="mb-4">
                                <label for="pasport" class="form-label">Завантажити договір</label>
                                <input class="form-control" type="file" name="pasport" id="pasport">
                            </div>
                            <div class="mb-4">
                                <label for="order" class="form-label">Завантажити дозвіл</label>
                                <input class="form-control" type="file" name="order" id="order">
                            </div>
                            <div class="mb-4">
                                <label for="additional" class="form-label">Завантажити додаткові документи</label>
                                <input class="form-control" type="file" name="additional[]" id="additional" multiple>
                            </div>
                            <div class="mb-4">
                                <label for="text" class="form-label">Контент <span class="text-danger">*</span></label>
                                <textarea name="text" id="text" class="form-control" placeholder="Контент">{{ old('text') }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label for="map" class="form-label">Карта <span class="text-danger">*</span></label>
                                <div id="map" style="width: 100%; height: 500px"></div>
                            </div>
                            <div class="mb-4">
                                <label for="lat" class="form-label">Широта (Lat) <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="lat" id="lat"
                                    value="{{ old('lat') }}">
                            </div>
                            <div class="mb-4">
                                <label for="lon" class="form-label">Долгота (Lng / Lon) <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="lon" id="lon"
                                    value="{{ old('lon') }}">
                            </div>
                            <button type="submit" class="mt-3 btn app-btn-primary">Зберегти</button>
                        </div>
                    </div><!--//app-card-body-->
                </div><!--//app-card-->
            </div>
            <div class="col-12 col-md-3">
                <div class="app-card app-card-settings shadow-sm p-4 mb-4">
                    <div class="app-card-body">
                        <div class="settings-form">
                            <div class="form-group text-center">
                                <img src="" class="rounded w-100 mx-auto d-block mb-3" id="imgPreview">
                                <div class="fileUpload btn btn-success text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-upload" viewBox="0 0 16 16">
                                        <path
                                            d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                        <path
                                            d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                                    </svg>
                                    <input type="file" name="poster" class="form-control hide-input upload"
                                        id="imgInput" accept="image/*" />
                                    <span class="ms-2">Завантажити постер</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-card app-card-settings shadow-sm p-4 mb-4">
                    <div class="app-card-body">
                        <div class="settings-form">
                            <div class="text-center">
                                <div id="gallery" class="row mb-4"></div>
                                <div class="fileUpload btn btn-secondary text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                        <path
                                            d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z" />
                                    </svg>
                                    <input type="file" name="gallery[]" class="form-control hide-input upload"
                                        id="gallery_upload" multiple />
                                    <span class="ms-2">Завантажити галерею</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">
                        <div class="settings-form">
                            
                            <div class="text-center">
                                <div class="fileUpload btn btn-secondary text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                        <path
                                            d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z" />
                                    </svg>
                                    <input type="file" name="pasport" class="form-control" id="pasport" />
                                    <span class="ms-2">Завантажити технічний паспорт</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="{{ asset('/js/dashboard/ckeditor/ckeditor.js') }}" type="text/javascript" charset="utf-8"></script>
    <script src="{{ asset('js/dashboard/slugify.js') }}"></script>
    <script src="{{ asset('js/dashboard/uploads.js') }}"></script>
    <script src="{{ asset('js/leaflet.js') }}"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script>
        CKEDITOR.replace('text', {
            filebrowserUploadMethod: 'form',
            font_defaultLabel: 'Roboto',
            filebrowserUploadUrl: "{{ route('fileupload', ['_token' => csrf_token()]) }}",
            height: '450px',
        });
    </script>
    <script>
        //map initialization
        var map = L.map('map').setView([47.817348, 35.105267], 12);
        mapLink =
            '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; ' + mapLink + ' Contributors',
                maxZoom: 18,
            }).addTo(map);
        var _geocoderType = L.Control.Geocoder.nominatim();
        var geocoder = L.Control.geocoder({
            geocoder: _geocoderType
        }).addTo(map);
        geocoder.on('markgeocode', function(event) {
            var center = event.geocode.center;
            L.marker(center).addTo(map);
            map.setView(center, map.getZoom());
        });
        var popup = L.popup();
        function onMapClick(e) {
            var coords = e.latlng;
            document.getElementById('lat').value = coords.lat;
            document.getElementById('lon').value = coords.lng;
            popup
                .setLatLng(e.latlng)
                .setContent('Широта: ' + coords.lat + ' | ' + 'Долгота: ' + coords.lng)
                .openOn(map);
        }
        map.on('click', onMapClick);
    </script>
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('css/upload.css') }}">
    <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        #map {
            width: 600px;
            height: 400px;
        }
    </style>
@endpush
