<x-layouts.app.sidebar :pageTitle="'Arabhardware | Home'">
    <x-mary-main with-nav full-width>
        <livewire:layouts.sidebar />

        <!-- Content Area -->
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-mary-main>
</x-layouts.app.sidebar>
