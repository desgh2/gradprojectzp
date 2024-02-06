<div>
    @include('breadcrumbs', [
        'breadcrumbs' => [
            'real-estate' => 'Нерухоме майно',
        ],
    ])
    <div class="container">
        <div class="row">
            @if ($districts)
                <div class="category-sidebar col-12 col-lg-3">

                    <p class="fs-5 fw-bold pb-3 mb-3">Оберіть район</p>
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
                <div class="category-main col-12 col-lg-8 offset-lg-1">
                    <h1 class="category-title">{{ $heading }}</h1>
                    <div class="row">
                        @if ($rows->isNotEmpty())
                            @foreach ($rows as $row)
                                <div class="real-estate-box d-block col-lg-12">
                                    <div class="cards row">
                                        <div class="col-6">
                                            <img src="{{ asset("uploads/estate/{$row->id}/{$row->poster}") }}"
                                                class="my-0 w-100 card-img-top" alt="...">
                                        </div>
                                        <div class="col-lg-6 cards-body">
                                            <p class="card-text fw-bold fs-5">{{ $row->name }}</p>
                                            {!! $row->text !!}
                                            <a href="{{ route('front.realestate.show', ['estate' => $row->slug]) }}"
                                                class="btn btn-primary text-white mt-2">Детальніше</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{ $rows->links() }}
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
