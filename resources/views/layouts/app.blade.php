<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
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
                            <a href="#">
                                <i class="bi bi-telephone-forward-fill"></i> <span>Зворотній зв’язок</span>
                            </a>
                            <a data-bs-toggle="collapse" href="#collapseSearch" role="button" aria-expanded="false" aria-controls="collapseSearch">
                                <i class="bi bi-search"></i> <span>Пошук</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <nav d="primary-menu" class="primary-menu navbar navbar-expand-lg">
                <div class="container">
                    <button class="mobile-toggler-menu navbar-toggler mx-auto" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-expanded="false"><i class="bi bi-list"></i></button>
                    <div class="collapse navbar-collapse" id="mobileMenu">
                        <div><a class="nav-link" href="#">ПРО КП “ГРАДПРОЕКТ”</a></div>
                        <div><a class="nav-link" href="{{ route('projects') }}">Проєкти</a></div>
                        <div><a class="nav-link" href="#">РЕКЛАМА</a></div>
                        <div><a class="nav-link" href="#">ЗЕМЛЕУСТРІЙ</a></div>
                        <div><a class="nav-link" href="#">ГЕОДЕЗІЯ</a></div>
                        <div><a class="nav-link" href="#">Нерухоме майно</a></div>
                    </div>
                </div>
            </nav>
            <div class="collapse bg-body-secondary" id="collapseSearch">
                <div class="container">
                    <div class="row">
                        <form action="" class="d-flex col-12 py-3">
                            <div class="w-100 me-3">
                                <input type="text" class="form-control input-field" placeholder="Що шукаємо?">
                            </div>
                            <div class="my-auto">
                                <button class="btn-search" type="button"><i class="bi bi-search"></i></button>
                            </div>
                            <div class="my-auto ms-3">
                                <a class="btn-default" data-bs-toggle="collapse" href="#collapseSearch" role="button" aria-expanded="false" aria-controls="collapseSearch">
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
                                <div class="ms-2 text-white">вул.Зелінського, 3, <br>м.Запоріжжя, 69126</div>
                            </div>
                            <div class="d-flex">
                                <div class="text-white"><i class="bi bi-clock" style="width: 50px;"></i></div>
                                <div class="ms-2 text-white">ПН-ПТ: 8:00-17:00</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-9">
                        <div class="row">
                            <div class="col-12  col-md-6 col-lg-6">
                                <div class="footer-menu">
                                    <div class="footer-menu-title">Про КП “Градпроект”</div>
                                    <ul class="footer-menu-list">
                                        <li><a href="#">Керівництво</a></li>
                                        <li><a href="#">Структура</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="footer-menu">
                                    <div class="footer-menu-title">Реклама</div>
                                    <ul class="footer-menu-list">
                                        <li><a href="#">Укладення та супровід договорів</a></li>
                                        <li><a href="#">Розміщення зовнішньої реклами</a></li>
                                        <li><a href="#">Демонтаж рекламних засобів </a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="footer-menu">
                                    <div class="footer-menu-title">Проєктування та забудова</div>
                                    <ul class="footer-menu-list">
                                        <li><a href="#">Проєктування</a></li>
                                        <li><a href="#">Реконструкція та капітальний ремонт</a></li>
                                        <li><a href="#">Паспортизація</a></li>
                                        <li><a href="#">Обстеження і оцінка</a></li>
                                        <li><a href="#">Супровід проєктної документації</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="footer-menu">
                                    <div class="footer-menu-title">Додатково</div>
                                    <ul class="footer-menu-list">
                                        <li><a href="#">Розробка землевпорядної документації</a></li>
                                        <li><a href="#">Топографо-геодезичні послуги</a></li>
                                        <li><a href="#">Винос в натуру меж земельних ділянок</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="../js/main.js"></script>
</body>

</html>
