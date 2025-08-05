<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

<head>
    @include('invoices::livewire.invoices.partials.admin.head', ['title' => $pageTitle ?? 'Admin Dashboard | Arabhardware'])
</head>

<body class="min-h-screen overflow-x-hidden" {{-- data-theme="dark" --}}>
    {{--  Navbar --}}
    <livewire:admin.navbar :badge="true" :logoText="false" />

    <x-mary-main with-nav full-width>

        <livewire:invoices.partials.admin.sidebar />

        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-mary-main>

    {{--  TOAST area --}}
    <x-mary-toast />

    <x-mary-spotlight
        shortcut="{{ str_contains(request()->header('User-Agent'), 'Mac') ? 'meta.k' : 'ctrl.k' }}"
        search-text="Find your apps"
        no-results-text="Ops! Nothing here.">
        {{-- <div x-data="{ query: { withUsers: true, withActions: true } }" x-init="$watch('query', value => $dispatch('mary-search', new URLSearchParams(value).toString()))" class="flex gap-8 p-3">
            <x-mary-checkbox label="Users" x-model="query.withUsers" />
            <x-mary-checkbox label="Actions" x-model="query.withActions" />
        </> --}}
    </x-mary-spotlight>

    @stack('modals')
</body>

</html>
