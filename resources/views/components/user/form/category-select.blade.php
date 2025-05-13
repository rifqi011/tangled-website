@props(['categories', 'selectedId' => null])

<div class="flex flex-col gap-1">
    <label class="text-lg font-semibold">Kategori</label>
    <div class="flex flex-wrap gap-2">
        @foreach ($categories as $category)
            <x-user.button type="button" class="select-category-btn {{ $selectedId == $category->id ? '!bg-purple !text-white' : '' }} border border-gray-500 !bg-gray-100 text-sm !text-black !transition-all hover:bg-gray-200 focus:outline-none" data-id="{{ $category->id }}">
                {{ $category->name }}
            </x-user.button>
        @endforeach
    </div>
    <input type="hidden" name="category_id" id="category_id" value="{{ $selectedId }}" required>
    @error('category_id')
        <p class="text-md mt-1 text-red">{{ $message }}</p>
    @enderror
</div>
