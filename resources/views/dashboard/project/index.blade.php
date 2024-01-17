@extends('layouts.master')
@section('title', 'Проєкти')
@section('content')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title">@yield('title')</h1>
        </div>
        <div class="col-auto">
            <a class="btn app-btn-secondary" href="{{ route('project.create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                </svg>
                Додати проєкт
            </a>
        </div><!--//col-auto-->
    </div>
    <div class="row">
        <div class="col-12">
            <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-body">
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
                                    <th class="meta cell">#</th>
                                    <th class="meta cell">Назва</th>
                                    <th class="meta cell">Відділ</th>
                                    <th class="meta cell">URL</th>
                                    <th class="meta cell">Статус</th>
                                    <th class="meta cell">Автор</th>
                                    <th class="meta cell"></th>
                                    <th class="meta cell"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projects as $project)
                                    <tr>
                                        <td class="cell">{{ $project->id }}</td>
                                        <td class="cell"><span class="truncate">{{ $project->name }}</span></td>
                                        <td class="cell">{{ $project->department->name }}</td>
                                        <td class="cell">{{ $project->slug }}</td>
                                        <td class="cell">
                                            <form action="{{ route('project.status', ['project' => $project->id]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="form-check form-switch form-switch-xl">
                                                    <input class="form-check-input" type="checkbox" role="switch"
                                                        id="post-status-{{ $project->id }}" name="status"
                                                        onchange="this.form.submit()"
                                                        {{ $project->status == $project::STATUS_ACTIVE ? 'checked' : '' }}>
                                                    <label class="form-check-label"
                                                        for="post-status-{{ $project->id }}"></label>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="cell">
                                            {{ $project->user->name }}
                                        </td>
                                        <td class="cell">
                                            <a class="btn btn-warning text-white" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Редагувати проєкт"
                                                href="{{ route('project.edit', ['project' => $project->id]) }}"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path
                                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd"
                                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                </svg></a>
                                        </td>
                                        <td class="cell">
                                            <form method="POST"
                                                action="{{ route('project.destroy', ['project' => $project->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger text-white"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-custom-class="custom-tooltip" data-bs-title="Видалити проєкт"
                                                    onclick="return confirm('Видалити проєкт?');">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16"
                                                        class="bi bi-trash" fill="currentColor"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                        <path fill-rule="evenodd"
                                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="cell" colspan="5">Проєктів не існує</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div><!--//table-responsive-->
                </div><!--//app-card-body-->
            </div>
            <nav class="app-pagination">
                {{ $projects->links() }}
            </nav>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
@endpush
