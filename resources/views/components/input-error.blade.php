@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'mt-1']) }}>
        @foreach ((array) $messages as $message)
            <li class="mt-1 small" style="color:red">{{ $message }}</li>
        @endforeach
    </ul>
@endif
