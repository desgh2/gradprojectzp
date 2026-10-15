@extends('layouts.master')
@section('title', 'Нерухоме майно')
@section('content')
<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title">@yield('title')</h1>
    </div>
    <div class="col-auto">
        <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                <div class="col-auto">
                    <form action="{{ route('estate.index') }}" class="docs-search-form row gx-1 align-items-center">
                        <div class="col-auto">
                            <div class="form-check">
                                <input class="form-check-input" name="pasport" type="checkbox" id="pasport" {{ request('pasport') ? 'checked' : '' }}>
                                <label class="form-check-label" for="pasport">
                                    Без тех.паспорта
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="poster" type="checkbox" id="poster" {{ request('poster') ? 'checked' : '' }}>
                                <label class="form-check-label" for="poster">
                                    Без фото
                                </label>
                            </div>
                        </div>
                        <div class="col-auto">
                            <select name="district" class="form-select w-auto" onchange="this.form.submit()">
                                <option value="">Вибрати район</option>
                                @foreach ($districts as $district)
                                <option value="{{ $district['id'] }}" @selected($district['id']==request('district'))>{{ $district['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="search" name="search" class="form-control" placeholder="Пошук">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn app-btn-secondary">Знайти</button>
                        </div>
                    </form>
                </div><!--//col-->

                <div class="col-auto">
                    <a class="btn app-btn-secondary" href="{{ route('estate.create') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                        </svg>
                        Додати запис
                    </a>
                </div>
            </div><!--//row-->
        </div>

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
                                <th class="meta cell text-center">Тех. паспорт</th>
                                <th class="meta cell">URL</th>
                                <th class="meta cell">Статус</th>
                                <th class="meta cell">Автор</th>
                                <th class="meta cell"></th>
                                <th class="meta cell"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rows as $row)
                            <tr>
                                <td class="cell">{{ $row->id }}</td>
                                <td class="cell">{{ $row->name }} ({{ $row->district() }})</td>
                                <td class="cell text-center">
                                    @if($row->pasport)
                                    <span class="text-success"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                        </svg></span>
                                    @else
                                    <span class="text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                        </svg></span>
                                    @endif
                                </td>
                                <td class="cell"><a href="{{ route('front.realestate.show', ['estate' => $row->slug]) }}" target="_blank">Перейти на запис</a></td>
                                <td class="cell">
                                    <form action="{{ route('estate.status', ['real_estate' => $row->id]) }}" method="POST">
                                        @csrf
                                        <div class="form-check form-switch form-switch-xl">
                                            <input class="form-check-input" type="checkbox" role="switch" id="post-status-{{ $row->id }}" name="status" onchange="this.form.submit()" {{ $row->status == $row::STATUS_ACTIVE ? 'checked' : '' }}>
                                            <label class="form-check-label" for="post-status-{{ $row->id }}"></label>
                                        </div>
                                    </form>
                                </td>
                                <td>{{ $row->user->name }}</td>
                                <td class="cell">
                                    <a class="btn btn-warning text-white" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Редагувати запис" href="{{ route('estate.edit', ['estate' => $row->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                        </svg></a>
                                </td>
                                <td class="cell">
                                    <form method="POST" action="{{ route('estate.destroy', ['estate' => $row->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger text-white" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" data-bs-title="Видалити запис" onclick="return confirm('Видалити запис?');">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="cell" colspan="5">Записів не існує</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--//table-responsive-->
            </div><!--//app-card-body-->
        </div>
        <nav class="app-pagination">
            {{-- {{ $rows->links() }} --}}
            {!! $rows->links() !!}
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