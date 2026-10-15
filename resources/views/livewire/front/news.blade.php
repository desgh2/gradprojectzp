<div>
    @include('breadcrumbs', [
        'breadcrumbs' => [
            'news' => 'Новини',
        ],
    ])
    <div class="container">
        <h1 class="page-title">{{ $heading }}</h1>
        <div class="row">
            @forelse ($news as $new)
                <div class="new-card-box col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                    <div class=" {{ $loop->even ? 'new-card-odd' : 'new-card' }}">
                        <div class="new-card-image">
                            <div class="new-card-time">{{ \Carbon\Carbon::parse($new->created_at)->format('d.m.Y') }}</div>
                            <img src="{{ asset("uploads/news/{$new->id}/{$new->poster}") }}" alt="">
                        </div>
                        <div class="new-card-text">
                            <a href="{{ route('front.post', ['post'=>$new->slug]) }}">{{ $new->name }}</a>
                            <p>{!! \Str::words($new->description, 10, '...') !!}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="new-card-box col-12">
                    <p class="fw-bold fs-2">Новин не існує</p>
                </div>
            @endforelse
        </div>
        {{ $news->links() }}
    </div>
</div>
