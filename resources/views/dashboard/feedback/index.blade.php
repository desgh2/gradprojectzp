@extends('layouts.master')
@section('title', 'Зворотній зв’язок')
@section('content')
    <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
            <h1 class="app-page-title">@yield('title')</h1>
        </div>
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
                                    <th class="meta cell">Ім`я</th>
                                    <th class="meta cell">Контакти</th>
                                    <th class="meta cell">Текст звернення</th>
                                    <th class="meta cell">Дата звернення</th>
                                    <th class="meta cell">Статус</th>
                                    <th class="meta cell"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rows as $row)
                                    <tr>
                                        <td class="cell">{{ $row->id }}</td>
                                        <td class="cell"><span class="truncate">{{ $row->name }}</span></td>
                                        <td class="cell">
                                            <div class="mb-1">{{ $row->phone }}</div>
                                            <div class="mb-1">{{ $row->email }}</div>
                                        </td>
                                        <td class="cell">{{ $row->text }}</td>
                                        <td class="cell"><span class="truncate">{{ $row->created_at }}</span></td>
                                        <td class="cell">
                                            <form action="{{ route('feedback.status', ['feedback' => $row->id]) }}" method="POST">
                                                @csrf
                                                <select name="status" class="form-select" id="status-{{ $row->id }}" onchange="this.form.submit()">
                                                    @foreach ($statuses as $key => $status)
                                                        <option value="{{ $key }}" @selected($key == $row->status)>{{ $status['name'] }}</option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>
                                        <td class="cell">
                                            <form method="POST"
                                                action="{{ route('feedback.destroy', ['feedback' => $row->id]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger text-white"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-custom-class="custom-tooltip" data-bs-title="Видалити звернення"
                                                    onclick="return confirm('Видалити звернення?');">
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
                                        <td class="cell" colspan="5">Звернень не існує</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div><!--//table-responsive-->
                </div><!--//app-card-body-->
            </div>
            <nav class="app-pagination">
                {{ $rows->links() }}
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
