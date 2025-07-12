<x-roles::layouts.app.sidebar :pageTitle="$title ?? null">
    <x-mary-main full-width>
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-mary-main>
</x-roles::layouts.app.sidebar>
