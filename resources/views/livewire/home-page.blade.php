<div>
    <div class="container">
        @if ($departments->isNotEmpty())
        <div class="department-row row">
            @foreach ($departments as $dep)
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <a href="{{ route('front.department', ['department' => $dep->slug]) }}" class="department-card d-flex">
                    <div class="department-card-icon my-auto"><img src="{{ asset("uploads/department/icon/{$dep->icon}") }}" alt=""></div>
                    <div class="department-card-link my-auto">{{ $dep->name }}</div>
                </a>
            </div>
            @endforeach
        </div>
        @endif
        <div class="home-title">Головні принципи КП “ГРАДПРОЕКТ” </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="about-info-box">
                    <div class="about-info-number">1</div>
                    <div class="about-info-title">ЯКІСТЬ</div>
                    <div class="about-info-text">Наше підприємсвто впевнено в тому, щоб стати лідером у своїй галузі,
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
                    <div class="about-info-text">Ми працюємо якісно та оперативно, щоб наші клієнти отримували виконану
                        роботу в точно визначені терміни.</div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="about-info-box">
                    <div class="about-info-number">4</div>
                    <div class="about-info-title">ІНДИВІДУАЛЬНИЙ ПІДХІД</div>
                    <div class="about-info-text">Сучасному клієнтові необхідні нестандартні рішення та індивідуальний
                        підхід, тому ми працюємо саме так.</div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @push('scripts')
    <script src="{{ asset('js/main.js') }}"></script>
@endpush --}}
