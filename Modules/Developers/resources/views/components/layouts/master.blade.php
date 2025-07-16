<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f11420;
        }

        .organic-shape {
            position: absolute;
            z-index: 11;
        }

        .organic-shape #hands-svg {
            transform: rotate(-25deg) !important;
            opacity: 1 !important;
        }

        .wave-bottom {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 20vh;
            background: white;
            clip-path: polygon(0% 60px,
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
                    0% 100%);
        }

        .arrow {
            position: absolute;
            width: 60px;
            height: 3px;
            transform: rotate(-15deg);
        }

        .arrow::after {
            position: absolute;
            right: -8px;
            top: -6px;
            width: 0;
            height: 0;
        }

        .arrow svg {
            transform: rotate(x);
        }

        .page {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: oklch(14% 0.005 285.823);
        }

        .loading-blurbs {
            width: 400px;
            height: 180px;
            text-align: center;
            position: relative;
        }

        .loading-blurbs code {
            --animation-duration: 500ms;
            display: block;
            position: absolute;
            width: 100%;
            bottom: 0;
            animation-name: move;
            animation-duration: calc(var(--animation-duration) * 8);
            animation-timing-function: ease-in-out;
            animation-iteration-count: infinite;
            opacity: 0;
        }

        @keyframes move {
            from {
                transform: translateY(0);
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: translateY(-170px);
                opacity: 0;
            }
        }

        .loading-blurbs code.typescript {
            animation-delay: var(--animation-duration);
        }

        .loading-blurbs code.ruby {
            animation-delay: calc(var(--animation-duration) * 2);
        }

        .loading-blurbs code.csharp {
            animation-delay: calc(var(--animation-duration) * 3);
        }

        .loading-blurbs code.cplusplus {
            animation-delay: calc(var(--animation-duration) * 4);
        }

        .loading-blurbs code.java {
            animation-delay: calc(var(--animation-duration) * 5);
        }

        .loading-blurbs code.swift {
            animation-delay: calc(var(--animation-duration) * 6);
        }

        .loading-blurbs code.php {
            animation-delay: calc(var(--animation-duration) * 7);
        }
    </style>
</head>

<body class="min-h-screen overflow-x-hidden">
    {{-- <nav class="relative z-20 flex items-center justify-between px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex md:flex space-x-8 items-center">
            <h1 class="text-2xl flex space-x-1  font-bold text-gray-900">
                <x-app-logo-icon white class="w-8" />
                <div class="badge badge-neutral badge-outline mt-1">for developers</div>
            </h1>
            <div class="hidden md:flex items-center space-x-8">
                <a href="/api/docs" class="text-amber-50 hover:text-grey-700 font-medium transition-colors">API</a>
                <a href="#" class="text-amber-50 hover:text-grey-700 font-medium transition-colors">Docs</a>
                <a href="#"
                    class="text-amber-50 hover:text-grey-700 font-medium transition-colors">Community</a>
            </div>
        </div>



        <div class="flex items-center space-x-4">
            @guest
                <a href="{{ route('login', ['from' => 'developers']) }}" class="text-amber-50 hover:text-grey-700 font-medium transition-colors cursor-pointer" >Sign In</a>

                <a href="{{ route('register', ['from' => 'developers']) }}"
                    class="btn btn-ghost btn-sm sm:btn-sm md:btn-md lg:btn-md xl:btn-md  cursor-pointer text-sm font-medium tracking-wide text-white  rounded-md bg-neutral-950 hover:bg-neutral-900 " >Join Now</a>
            @else
                <a href="{{ route('developers.dashboard') }}"
                    class="btn btn-ghost btn-sm sm:btn-sm md:btn-md lg:btn-md xl:btn-md  cursor-pointer text-sm font-medium tracking-wide text-white  rounded-md bg-neutral-950 hover:bg-neutral-900 " >Dashboard</a>
            @endguest

        </div>

        <!-- Mobile menu button -->
        <button class="md:hidden p-2" onclick="toggleMobileMenu()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>
    </nav> --}}
    {{ $slot }}
</body>

</html>
