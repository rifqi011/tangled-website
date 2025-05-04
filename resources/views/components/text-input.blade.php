@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => ' px-4 py-2 border border-gray-300 focus:border-purple/70 focus:ring-purple/70 rounded-md shadow-sm']) }}>
