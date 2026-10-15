<div>
    <div class="container">
        @if ($projects->isNotEmpty() && $news->isNotEmpty())
        <h1 class="page-title">Результат пошуку</h1>
        @else
        <h1 class="page-title">За Вашим запитом записів не знайдено</h1>
        @endif
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="row">
                    @if ($projects->isNotEmpty())
                        <div class="fw-bold fs-3 border-bottom border-1 pb-3 mb-3">Проєкти</div>
                        @foreach ($projects as $p)
                            <div class="searching-box">
                                <a href="{{ route('front.project', ['project' => $p->slug]) }}" class="searching-box-name">{{ $p->name }}</a>
                                <p>{!! \Str::words($p->description, 10, '...') !!}</p>
                            </div>
                        @endforeach
                    @endif
                    @if ($news->isNotEmpty())
                        <div class="fw-bold fs-3 border-bottom border-1 pb-3 mb-3">Новини</div>
                        @foreach ($news as $n)
                            <div class="searching-box">
                                <a href="{{ route('front.post', ['post' => $n->slug]) }}" class="searching-box-name">{{ $n->name }}</a>
                                <p>{!! \Str::words($n->description, 10, '...') !!}</p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
