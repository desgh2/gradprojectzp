<div>
    <div class="container">
        @if ($departments->isNotEmpty())
            <div class="department-row row">
                @foreach ($departments as $dep)
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.department', ['department' => $dep->slug]) }}"
                            class="department-card d-flex">
                            <div class="department-card-icon my-auto"><img
                                    src="{{ asset("uploads/department/icon/{$dep->icon}") }}" alt=""></div>
                            <div class="department-card-link my-auto">{{ $dep->name }}</div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
        @if ($news->isNotEmpty() && $news->count() > 3)
        <div class="post-box">
            <div class="home-title text-center">Новини</div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-theme" id="home-post-carousel">
                        @foreach ($news as $post)
                        <div class="item card-post">
                            <img src="{{ asset("uploads/news/{$post->id}/{$post->poster}") }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <a href="{{ route('front.post', ['post'=>$post->slug]) }}" class="card-title">{{ $post->name }}</a>
                                <p class="card-text">{!! \Str::words($post->description, 10, '...') !!}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="home-title text-center">Головні принципи КП “ГРАДПРОЕКТ” </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="about-info-box">
                    <div class="about-info-number">1</div>
                    <div class="about-info-title">ЯКІСТЬ</div>
                    <div class="about-info-text">Наше підприємсвто впевнено в тому, щоб стати лідером у своїй
                        галузі,
                        треба якісно виконувати свою роботу.</div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="about-info-box">
                    <div class="about-info-number">2</div>
                    <div class="about-info-title">ПРОФЕСІОНАЛІЗМ</div>
                    <div class="about-info-text">У нас працюють справжні майстри своєї справи, які вміють виконувати
                        свою роботу на високому професійному рівні.</div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="about-info-box">
                    <div class="about-info-number">3</div>
                    <div class="about-info-title">ДОТРИМАННЯ ТЕРМІНІВ</div>
                    <div class="about-info-text">Ми працюємо якісно та оперативно, щоб наші клієнти отримували
                        виконану
                        роботу в точно визначені терміни.</div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="about-info-box">
                    <div class="about-info-number">4</div>
                    <div class="about-info-title">ІНДИВІДУАЛЬНИЙ ПІДХІД</div>
                    <div class="about-info-text">Сучасному клієнтові необхідні нестандартні рішення та
                        індивідуальний
                        підхід, тому ми працюємо саме так.</div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            center: true,
            responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 1,
                },
                768: {
                    items: 1,
                },
                992: {
                    items: 3,
                }
            },
            navText: ["<i class='bi bi-chevron-left'></i>", "<i class='bi bi-chevron-right'></i>"]
        })
    </script>
@endpush
@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
@endpush
