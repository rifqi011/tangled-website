@props(['classes', 'selectedId' => null])

<div class="flex flex-col gap-1">
    <label for="class_id" class="text-lg font-semibold">Masukan Kelas</label>
    <select name="class_id" id="class_id" class="@error('class_id') !border-2 !border-red @enderror border-2 w-full rounded-2xl border-gray-300 bg-no-repeat px-4 py-2 text-black placeholder:text-black" style="appearance: none; background-image: url('/images/icons/angle-down.svg'); background-position: right 0.7rem center;">
        @foreach ($classes as $class)
            <option value="{{ $class->id }}" {{ $selectedId == $class->id ? 'selected' : '' }}>
                {{ $class->name }}
            </option>
        @endforeach
    </select>
    @error('class_id')
        <p class="text-md mt-1 text-red">{{ $message }}</p>
    @enderror
</div>
