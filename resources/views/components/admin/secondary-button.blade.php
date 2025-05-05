<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-purple rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-purple/80 focus:outline-none focus:ring-2 focus:ring-purple focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
