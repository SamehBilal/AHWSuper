<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">

    <div
        class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
        <div
            class="bg-muted relative hidden h-full flex-col p-10 text-white lg:flex dark:border-e dark:border-neutral-800">
            <div class="absolute inset-0 split-bg bg-neutral-900"
                style="{{ request('from') === 'developers'
                    ? ''
                    : "background-image: url('" . asset('build-roles/img/auth_aurora_2x.png') . "')" }}">
            </div>
            <a href="{{ route('home') }}" class="relative z-20 flex items-center text-lg font-medium" wire:navigate>
                <span class="flex h-10 w-10 items-center justify-center rounded-md">
                    <x-app-logo-icon 
                        class="me-2 fill-current text-white" />
                </span>
                {{ config('app.name', 'Arabhardware') }}
            </a>

            @php
                [$message, $author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
            @endphp

            <div class="relative z-20 mt-auto">
                @if (request('from') === 'developers')
                <div class="login-shape">
                    <div class="objects">
                        <div class="objects_computer"></div>
                        <div class="objects_table"></div>
                        <div class="objects_cup"></div>
                        <div class="smoke"></div>
                        <div class="objects_chair"></div>
                    </div>
                    <div class="box">
                        <div class="box_1">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <div class="box_2">
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        <div class="box_3"></div>
                    </div>
                </div>
                @endif
                <blockquote class="space-y-2">
                    <div class="font-medium [:where(&)]:text-white [:where(&)]:dark:text-white text-base [&:has(+[data-flux-subheading])]:mb-2 [[data-flux-subheading]+&]:mt-2"
                        size="lg">&ldquo;{{ trim($message) }}&rdquo;</div>
                    <footer>
                        <div
                            class="font-medium [:where(&)]:text-white [:where(&)]:dark:text-white text-sm [&:has(+[data-flux-subheading])]:mb-2 [[data-flux-subheading]+&]:mt-2">
                            {{ trim($author) }}</div>
                    </footer>
                </blockquote>
            </div>
        </div>
        <div class="w-full lg:p-8">
            <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                <div class="absolute top-4 right-4 z-30">
                    <x-mary-theme-toggle class="btn btn-circle" />
                </div>
                <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden"
                    wire:navigate>
                    <span class="flex h-9 w-9 items-center justify-center rounded-md">
                        <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                    </span>

                    <span class="sr-only">{{ config('app.name', 'Arabhardware') }}</span>
                </a>
                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
