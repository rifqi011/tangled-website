@props([
    'name' => 'photo',
    'label' => 'Gambar',
    'labelText' => 'Upload Gambar',
    'optional' => false,
])

<div class="flex flex-col gap-1">
    <label for="{{ $name }}" class="text-lg font-semibold">{{ $label }}{{ $optional ? ' (opsional)' : '' }}</label>
    <div class="flex flex-col">
        <label for="{{ $name }}" id="upload-label" class="@error($name) !border-red border-2 @enderror cursor-pointer rounded-3xl bg-black px-4 py-2 text-center text-white">{{ $labelText }}</label>
        <input type="file" name="{{ $name }}" id="{{ $name }}" class="hidden">
        <p id="file-chosen" class="mt-2 text-sm text-gray-600">Tidak ada file dipilih</p>
    </div>
    @error($name)
        <p class="text-md mt-1 text-red">{{ $message }}</p>
    @enderror
</div>
