<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- SEO TOOLS -->
    {!! SEO::generate() !!}
    <!-- Fonts -->
    @stack('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/xs.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sm.css') }}">
    <link rel="stylesheet" href="{{ asset('css/md.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lg.css') }}">
    <link rel="stylesheet" href="{{ asset('css/xl.css') }}">
    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body>
    <div id="wrapper">
        <header>
            <div class="container top-header">
                <div class="row">
                    <div class="col-12 col-lg-6 logotype">
                        <a href="{{ route('front.index') }}">
                            <img src="{{ asset('images/logotype.svg') }}" alt="">
                        </a>
                    </div>
                    <div class="about-menu col-12 col-lg-6 my-auto">
                        <div class="about-menu d-flex justify-content-around">
                            <a href="{{ route('front.contact') }}">
                                <i class="bi bi-telephone-fill"></i> <span>Контакти</span>
                            </a>
                            <a href="{{ route('front.feedback') }}">
                                <i class="bi bi-telephone-forward-fill"></i> <span>Зворотній зв’язок</span>
                            </a>
                            <a data-bs-toggle="collapse" href="#search" role="button" aria-expanded="false"
                                aria-controls="search">
                                <i class="bi bi-search"></i> <span>Пошук</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <nav d="primary-menu" class="primary-menu navbar navbar-expand-lg">
                <div class="container">
                    <button class="mobile-toggler-menu navbar-toggler mx-auto" type="button" data-bs-toggle="collapse"
                        data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-expanded="false"><i
                            class="bi bi-list"></i></button>
                    @livewire('front.primary-menu')
                </div>
            </nav>
            <div class="collapse {{ request()->routeIs('front.search') ? 'show' : '' }} bg-body-secondary"
                id="search">
                <div class="container">
                    <div class="row">
                        <form action="{{ route('front.search') }}" method="GET" class="d-flex col-12 py-3">
                            <div class="w-100 me-3">
                                <input type="text" name="s" class="form-control input-field"
                                    value="{{ request('s') ?? '' }}" placeholder="Що шукаємо?">
                            </div>
                            <div class="my-auto">
                                <button class="btn-search" type="submit"><i class="bi bi-search"></i></button>
                            </div>
                            <div class="my-auto ms-3">
                                <a class="btn-default" data-bs-toggle="collapse" href="#search" role="button"
                                    aria-expanded="false" aria-controls="search">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <main>
            @yield('content')
        </main>
        <footer class="footer" id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-3 footer-logotype">
                        <img src="{{ asset('images/footer-logotype.svg') }}" alt="">
                        <div class="footer-about-list">
                            <div class="d-flex mb-3">
                                <div class="text-white">
                                    <i class="bi bi-geo-alt-fill" style="width: 50px;"></i>
                                </div>
                                <div class="ms-2 text-white">{!! app('setting')->address !!}</div>
                            </div>
                            <div class="d-flex">
                                <div class="text-white"><i class="bi bi-clock" style="width: 50px;"></i></div>
                                <div class="ms-2 text-white">{{ app('setting')->work_time }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-9">
                        @livewire('front.footer-menu')
                    </div>
                </div>
            </div>
        </footer>
        <a href="#" id="scrolltop"><i class="bi bi-chevron-up"></i></a>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
