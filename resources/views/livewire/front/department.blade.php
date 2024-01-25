<div>
    @include('breadcrumbs', [
        'breadcrumbs' => [
            'departments' => 'Відділи',
            $department->slug => $department->name,
        ],
    ])
    <div class="container">
        <h1 class="department-title">{{ $department->name }}</h1>
        <div class="row">
            <div class="department-person col-md-12 col-lg-3">
                <div class="department-person-box">
                    <div class="department-person-box-image">
                        <img src="{{ asset("uploads/photos/{$department->person->photo}") }}" class="w-100" alt="">
                    </div>
                    <div class="department-person-box-name">
                        {{ $department->person->fullName() }}
                    </div>
                    <div class="department-person-box-post">
                        {{ $department->person->post }}
                    </div>
                </div>
            </div>
            <div class="department-text col-md-12 col-lg-8 offset-lg-1">
                {!! $department->text !!}
            </div>
            @if ($department->projects->isNotEmpty())
            <div class="mt-5 col-12">
                <div class="department-second-title mb-5">Проєкти</div>
                <div class="row">
                    @foreach ($department->projects as $project)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="department-card-project">
                            <div class="department-card-project-image">
                                <img src="{{ asset("uploads/projects/{$project->id}/{$project->poster}") }}" class="" alt="">
                            </div>
                            <div class="department-card-project-title">{{ $project->name }}</div>
                            <div class="department-card-project-text">
                                <p>{!! \Str::words($project->description, 10, '...') !!}</p>
                                <a href="{{ route('front.project', ['project'=>$project->slug]) }}">Детальніше</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
