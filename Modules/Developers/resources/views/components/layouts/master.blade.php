<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('developers::partials.theme.head')
</head>

<body class="min-h-screen overflow-x-hidden">
    @include('developers::partials.theme.navbar', ['class' => $navbarClass ?? 'bg-primary'])
        {{ $slot }}

    @include('developers::partials.theme.footer', ['wave' => true])

    <x-cookies />
</body>

</html>
