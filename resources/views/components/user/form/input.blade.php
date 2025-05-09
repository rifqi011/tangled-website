@props(['name', 'label', 'type' => 'text', 'value' => '', 'placeholder' => '', 'required' => false, 'maxlength' => null, 'autofocus' => false, 'rows' => null, 'inputmode' => null])

<div class="flex flex-col gap-1">
    <label for="{{ $name }}" class="text-lg font-semibold">{{ $label }}</label>

    @if ($type === 'textarea')
        <textarea name="{{ $name }}" id="{{ $name }}" rows="{{ $rows ?? 4 }}" class="@error($name) !border-2 !border-red @enderror border-2 w-full rounded-xl border-gray-300 px-4 py-2 text-black placeholder:text-gray-600 focus:border-purple" {{ $required ? 'required' : '' }} placeholder="{{ $placeholder }}">{{ $value }}</textarea>
    @else
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}" class="@error($name) !border-2 !border-red @enderror border-2 w-full rounded-xl border-gray-300 px-4 py-2 text-black placeholder:text-gray-600 focus:border-purple" autocomplete="off" placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} {{ $maxlength ? 'maxlength=' . $maxlength : '' }} {{ $autofocus ? 'autofocus' : '' }} {{ $inputmode ? 'inputmode=' . $inputmode : '' }}>
    @endif

    @error($name)
        <p class="text-md mt-1 text-red">{{ $message }}</p>
    @enderror
</div>
