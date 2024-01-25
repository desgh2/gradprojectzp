<div>
    <h1 class="category-title">{{ $heading }}</h1>
    <div class="row" style="margin-top: 90px;">
        @forelse ($persons as $person)
            <div class="col-12 col-md-6 col-xl-4">
                <div class="persons-box">
                    <img src="{{ asset("uploads/photos/{$person->photo}") }} " class="mx-auto d-block rounded-circle" alt="">
                    <a href="#" class="d-block">{{ $person->fullName() }}</a>
                    <p class="persons-post">{{ $person->post }}</p>
                    @if ($person->phone)
                        <p class="persons-phone"><i class="bi bi-telephone"></i> <span>{{ $person->phone }}</span></p>
                    @endif
                </div>
            </div>
        @empty
        @endforelse
    </div>
</div>
