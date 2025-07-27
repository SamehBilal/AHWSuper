<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

<head>
    @include('developers::livewire.partials.admin.head', ['title' => $pageTitle ?? 'Admin Dashboard | Arabhardware'])
</head>

<body class="min-h-screen overflow-x-hidden" data-theme="dark">
    <livewire:partials.admin.navbar />

    <x-mary-main with-nav full-width>

        <livewire:partials.admin.sidebar />

        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-mary-main>

    {{--  TOAST area --}}
    <x-mary-toast />

    <x-mary-spotlight search-text="Find your apps" no-results-text="Ops! Nothing here.">
        {{-- <div x-data="{ query: { withUsers: true, withActions: true } }" x-init="$watch('query', value => $dispatch('mary-search', new URLSearchParams(value).toString()))" class="flex gap-8 p-3">
            <x-mary-checkbox label="Users" x-model="query.withUsers" />
            <x-mary-checkbox label="Actions" x-model="query.withActions" />
        </> --}}
    </x-mary-spotlight>
</body>

</html>
