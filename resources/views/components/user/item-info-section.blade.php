@props(['fields' => []])

<div class="flex flex-col text-xl">
    @foreach ($fields as $label => $value)
        @if (!empty($value))
            <p><span class="font-semibold">{{ $label }}: </span>{{ $value }}</p>
        @endif
    @endforeach
</div>
