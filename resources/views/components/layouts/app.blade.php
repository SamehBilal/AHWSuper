<x-layouts.app.sidebar :title="$title ?? null">
    <input type="hidden" name="userId" value="{{ auth()->user()->id ?? '' }}" />
    <flux:main>
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
