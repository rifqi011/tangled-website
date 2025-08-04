<x-user.form.divider class="w-[90%] mx-auto" />

<footer class="mb-24 flex w-full flex-col items-center justify-center gap-2 text-lg font-medium">
    <p>&copy; {{ date('Y') }} Tangled. All rights reserved</p>
    <p>Made with ❤️ by <a href="/developers" class="font-semibold underline">Shifu Tech</a></p>
    <div class="flex gap-4">
        <a href="https://instagram.com/shifutechnology" target="_blank">
            <img src="{{ asset('images/icons/instagram.svg') }}" class="w-6" alt="instagram icon">
        </a>

        <a href="https://wa.me/62882003598475" target="_blank">
            <img src="{{ asset('images/icons/whatsapp.svg') }}" class="w-6" alt="whatsapp icon">
        </a>
    </div>
</footer>
