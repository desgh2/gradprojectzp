<div>
    @include('breadcrumbs', [
        'breadcrumbs' => [
            'projects' => 'Проєкти',
            $project->slug => $project->name,
        ],
    ])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="project-box">
                    {{-- <img src="../images/project1.png" alt=""> --}}
                    <img src="{{ asset("uploads/projects/{$project->id}/{$project->poster}") }}" class="w-100 h-50" alt="">
                    <div class="project-box-title">
                        <h1>{{ $project->name }}</h1>
                        <p>ресторан м.Запоріжжя</p>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="project-box-text">
                    {!! $project->text !!}
                </div>
            </div>
        </div>
    </div>
</div>
