<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('developers::livewire.partials.theme.head')
</head>

<body class="min-h-screen overflow-x-hidden">
    @include('developers::livewire.partials.theme.navbar', ['class' => $navbarClass ?? 'bg-primary'])
        {{ $slot }}

    @include('developers::livewire.partials.theme.footer', ['wave' => true])

    <x-cookies />
</body>

</html>
