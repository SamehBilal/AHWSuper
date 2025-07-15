<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    @include('partials.head')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        .organic-shape {
            position: absolute;
            z-index: 1;
        }

        .cactus {
            background: #22c55e;
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            position: relative;
        }

        .cactus::before {
            content: '';
            position: absolute;
            width: 30px;
            height: 60px;
            background: #22c55e;
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            left: -15px;
            top: 20px;
        }

        .cactus::after {
            content: '';
            position: absolute;
            width: 25px;
            height: 45px;
            background: #22c55e;
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            right: -12px;
            top: 15px;
        }

        .cactus-dot {
            position: absolute;
            width: 8px;
            height: 8px;
            background: #16a34a;
            border-radius: 50%;
        }

        .snake {
            background: #f97316;
            border-radius: 50px;
            position: relative;
            overflow: hidden;
        }

        .snake::before {
            content: '';
            position: absolute;
            width: 100px;
            height: 100px;
            background: #ea580c;
            border-radius: 50%;
            right: -20px;
            top: -20px;
        }

        .snake-dot {
            position: absolute;
            width: 12px;
            height: 12px;
            background: #fed7aa;
            border-radius: 50%;
        }

        .wave-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 120px;
            background: white;
            clip-path: polygon(
                0% 60px,
                5% 50px,
                10% 45px,
                15% 40px,
                20% 35px,
                25% 30px,
                30% 28px,
                35% 30px,
                40% 35px,
                45% 40px,
                50% 45px,
                55% 50px,
                60% 55px,
                65% 50px,
                70% 45px,
                75% 40px,
                80% 35px,
                85% 30px,
                90% 35px,
                95% 40px,
                100% 45px,
                100% 100%,
                0% 100%
            );
        }

        .arrow {
            position: absolute;
            width: 60px;
            height: 3px;
            background: #1f2937;
            transform: rotate(-15deg);
        }

        .arrow::after {
            content: '';
            position: absolute;
            right: -8px;
            top: -6px;
            width: 0;
            height: 0;
            border-left: 12px solid #1f2937;
            border-top: 6px solid transparent;
            border-bottom: 6px solid transparent;
        }

        .arrow-accent {
            position: absolute;
            width: 30px;
            height: 2px;
            background: #1f2937;
            transform: rotate(25deg);
        }

        .arrow-accent::after {
            content: '';
            position: absolute;
            right: -4px;
            top: -3px;
            width: 0;
            height: 0;
            border-left: 8px solid #1f2937;
            border-top: 3px solid transparent;
            border-bottom: 3px solid transparent;
        }
    </style>
</head>
<!-- No additional code needed here, background will be set via Tailwind class on <body> -->



<body class="bg-yellow-400 min-h-screen overflow-x-hidden" x-data x-on:set-page-title.window="document.title = $event.detail.title">
    {{-- <x-mary-main with-nav full-width> --}}
        <!-- Content Area -->
        {{-- <x-slot:content> --}}
            {{ $slot }}
        {{-- </x-slot:content> --}}
   {{--  </x-mary-main> --}}


    {{-- <x-cookies /> --}}
</body>

</html>
