<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main>
        {{ $slot }}
    </flux:main>

    @vite('resources/js/app.js')
</x-layouts.app.sidebar>
