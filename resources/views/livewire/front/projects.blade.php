<div>
    @include('breadcrumbs', [
        'breadcrumbs' => [
            'projects'=> 'Проєкти',
        ],
    ])
    <div class="container">
        <h1 class="page-title">{{ $heading }}</h1>
        <div class="row">
            @forelse ($projects as $project)
            <div class="projects-box col-12 col-md-6 col-lg-6">
                <div class="projects-box-image">
                    <img src="{{ asset("uploads/projects/{$project->id}/{$project->poster}") }}" alt="">
                </div>
                <div class="projects-box-status">В проєктному портфоліо</div>
                <a href="{{ route('front.project', ['project'=>$project->slug]) }}" class="d-block">{{ $project->name }}</a>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse ipsum molestias facilis velit dolor
                    saepe. Sit voluptatibus, unde fugiat mollitia eligendi distinctio aperiam minus voluptatem sapiente
                    eius reiciendis ad quod totam
                    consectetur nihil deserunt doloremque?</p>
            </div>
            @empty
            <div class="projects-box col-12">
                <p class="fw-bold fs-2">Проєктів не існує</p>
            </div>
            @endforelse
        </div>
        {{ $projects->links() }}
    </div>
</div>
