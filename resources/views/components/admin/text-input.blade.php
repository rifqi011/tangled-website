@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => ' px-4 py-2 border border-gray-300 focus:border-purple focus:ring-purple rounded-md shadow-sm']) }}>
