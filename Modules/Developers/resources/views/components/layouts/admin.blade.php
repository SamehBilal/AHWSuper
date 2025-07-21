<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

<head>
    @include('partials.head')
</head>

<body class="min-h-screen overflow-x-hidden">
   <livewire:partials.admin.navbar />

    <x-mary-main with-nav full-width>

        <livewire:partials.admin.sidebar />

        <x-slot:content>
            {{ $slot }}
            <x-mary-theme-toggle class="btn" @theme-changed="console.log($event.detail)" />
        </x-slot:content>
    </x-mary-main>

    {{--  TOAST area --}}
    <x-mary-toast />
    <x-mary-spotlight search-text="Find docs, app actions or users" no-results-text="Ops! Nothing here." />
</body>

</html>
