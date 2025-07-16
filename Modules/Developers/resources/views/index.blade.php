<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

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

        .organic-shape svg {
            fill: #fff;
            transform: rotate(25deg);
            opacity: 0.9;
        }

        .organic-shape #hands-svg {
            transform: rotate(-25deg) !important;
            opacity: 1 !important;
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
            height: 25vh;
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



<body class="bg-yellow-400 min-h-screen overflow-x-hidden">
<div>

    <nav class="relative z-20 flex items-center justify-between px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex md:flex space-x-8 items-center">
            <h1 class="text-2xl flex space-x-1  font-bold text-gray-900">
                <x-app-logo-icon white class="w-8" />
                <div class="badge badge-neutral badge-outline mt-1">for developers</div>
            </h1>
            <div class="hidden md:flex items-center space-x-8">
                <a href="#" class="text-amber-50 hover:text-grey-700 font-medium transition-colors">Home</a>
                <a href="#" class="text-amber-50 hover:text-grey-700 font-medium transition-colors">API</a>
                <a href="#" class="text-amber-50 hover:text-grey-700 font-medium transition-colors">Docs</a>
                <a href="#" class="text-amber-50 hover:text-grey-700 font-medium transition-colors">Community</a>
            </div>
        </div>



        <div class="flex items-center space-x-4">
            <button class="text-amber-50 hover:text-grey-700 font-medium transition-colors cursor-pointer">Sign
                In</button>
            <button
                class="bg-amber-50 text-grey-900 px-6 py-2 rounded-lg hover:bg-transparent transition-colors cursor-pointer font-medium">Join
                Now</button>
        </div>

        <!-- Mobile menu button -->
        <button class="md:hidden p-2" onclick="toggleMobileMenu()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>
    </nav>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-yellow-400 px-4 py-2 relative z-20">
        <div class="flex flex-col space-y-2">
            <a href="#" class="text-amber-50 hover:text-grey-700 font-medium py-2">Home</a>
            <a href="#" class="text-amber-50 hover:text-grey-700 font-medium py-2">Features</a>
            <a href="#" class="text-amber-50 hover:text-grey-700 font-medium py-2">Pricing</a>
            <a href="#" class="text-amber-50 hover:text-grey-700 font-medium py-2">Blog</a>
        </div>
    </div>

    <!-- Main Content -->
    <main
        class="relative z-10 flex flex-col items-center justify-center min-h-[calc(100vh-260px)] px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="text-center max-w-4xl mx-auto">
            <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-amber-50 mb-6 leading-tight">
                Start Building Today
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl text-amber-50 mb-8 max-w-2xl mx-auto">
                Tools and APIs to power your next app.
            </p>

            <!-- CTA Button with Arrows -->
            <div class="relative inline-block">
                <!-- Left Arrow -->
                <div class="arrow" style="left: -120px; top: 25px;"></div>

                <!-- Right Arrow Accent -->
                <div class="arrow-accent" style="right: -100px; top: 35px;"></div>
                <div class="arrow-accent" style="right: -110px; top: 25px;"></div>

                <button class="btn btn-neutral btn-xs sm:btn-sm md:btn-md lg:btn-lg xl:btn-xl cursor-pointer">Get
                    Started</button>

                {{-- <button
                    class="bg-gray-900 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-800 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Get Started
                </button> --}}
            </div>
        </div>
    </main>

    <!-- Decorative Elements -->
    <!-- Cactus (Left Side) -->
    <div class="organic-shape left-4 sm:left-8 md:left-16 top-1/2 transform -translate-y-1/2">

        <svg id="hands-svg" version="1.1" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="350px" height="350px"
            viewBox="0 0 196 196" enable-background="new 0 0 196 196" xml:space="preserve">
            <g id="keyboard_full">
                <g id="keyboard">

                    <rect id="body" x="21" y="77" fill="#FFFFFF" stroke="#010202" stroke-width="3"
                        stroke-linecap="square" stroke-miterlimit="10" width="153" height="57" />
                    <g id="keys">
                        <rect x="27.5" y="83.5" fill="#f11420" width="8" height="8" />
                        <rect x="39.5" y="83.5" fill="#f11420" width="8" height="8" />
                        <rect x="51.5" y="83.5" fill="#f11420" width="8" height="8" />
                        <rect x="63.5" y="83.5" fill="#f11420" width="8" height="8" />
                        <rect x="75.5" y="83.5" fill="#f11420" width="8" height="8" />
                        <rect x="87.5" y="83.5" fill="#f11420" width="8" height="8" />
                        <rect x="99.5" y="83.5" fill="#f11420" width="8" height="8" />
                        <rect x="111.5" y="83.5" fill="#f11420" width="8" height="8" />
                        <rect x="123.5" y="83.5" fill="#f11420" width="8" height="8" />
                        <rect x="135.5" y="83.5" fill="#f11420" width="8" height="8" />
                        <rect x="147.5" y="83.5" fill="#f11420" width="8" height="8" />
                        <rect x="159.5" y="83.5" fill="#f11420" width="8" height="8" />
                        <rect x="27.5" y="95.5" fill="#f11420" width="8" height="8" />
                        <rect x="39.5" y="95.5" fill="#f11420" width="8" height="8" />
                        <rect x="51.5" y="95.5" fill="#f11420" width="8" height="8" />
                        <rect x="63.5" y="95.5" fill="#f11420" width="8" height="8" />
                        <rect x="75.5" y="95.5" fill="#f11420" width="8" height="8" />
                        <rect x="87.5" y="95.5" fill="#f11420" width="8" height="8" />
                        <rect x="99.5" y="95.5" fill="#f11420" width="8" height="8" />
                        <rect x="111.5" y="95.5" fill="#f11420" width="8" height="8" />
                        <rect x="123.5" y="95.5" fill="#f11420" width="8" height="8" />
                        <rect x="135.5" y="95.5" fill="#f11420" width="8" height="8" />
                        <rect x="147.5" y="95.5" fill="#f11420" width="8" height="8" />
                        <rect x="159.5" y="95.5" fill="#f11420" width="8" height="8" />
                        <rect x="27.5" y="107.5" fill="#f11420" width="8" height="8" />
                        <rect x="39.5" y="107.5" fill="#f11420" width="8" height="8" />
                        <rect x="51.5" y="107.5" fill="#f11420" width="8" height="8" />
                        <rect x="63.5" y="107.5" fill="#f11420" width="8" height="8" />
                        <rect x="75.5" y="107.5" fill="#f11420" width="8" height="8" />
                        <rect x="87.5" y="107.5" fill="#f11420" width="8" height="8" />
                        <rect x="99.5" y="107.5" fill="#f11420" width="8" height="8" />
                        <rect x="111.5" y="107.5" fill="#f11420" width="8" height="8" />
                        <rect x="123.5" y="107.5" fill="#f11420" width="8" height="8" />
                        <rect x="135.5" y="107.5" fill="#f11420" width="8" height="8" />
                        <rect x="147.5" y="107.5" fill="#f11420" width="8" height="8" />
                        <rect x="159.5" y="107.5" fill="#f11420" width="8" height="8" />
                        <rect x="27.5" y="119.5" fill="#f11420" width="8" height="8" />
                        <rect x="39.5" y="119.5" fill="#f11420" width="8" height="8" />
                        <rect x="51.5" y="119.5" fill="#f11420" width="92" height="8" />
                        <rect x="147.5" y="119.5" fill="#f11420" width="8" height="8" />
                        <rect x="159.5" y="119.5" fill="#f11420" width="8" height="8" />
                    </g>
                </g>
                <path id="cable" fill="none" stroke="#010202" stroke-width="3" stroke-linecap="square"
                    stroke-miterlimit="10"
                    d="M73.5,28
        L73.5,28c0,6.627,5.373,12,12,12h24h24c6.627,0,12,5.373,12,12l0,0c0,6.627-5.373,12-12,12h-24c-6.627,0-12,5.373-12,12l0,0" />
            </g>
            <g id="hands">
                <g id="left_hand">
                    <path fill="#FFFFFF" stroke="#010202" stroke-width="3" stroke-miterlimit="1" d="M66.64,168.001v-4l12.364-28.163
            c0.995-2.087,1.27-3.829-0.319-5.413s-4.185-2.049-5.867,0.729l-5.317,8.847v-4H43.138V123.69c0-2.076-1.821-3.759-4.067-3.759
            c-2.247,0-4.067,1.683-4.067,3.759v20.341l0.001,0.001V152l6.327,16" />
                    <path fill="#FFFFFF" stroke="#010202" stroke-width="3" stroke-miterlimit="1"
                        d="M59.408,119.206v18.833" />
                    <path id="left_index_finger" fill="#FFFFFF" stroke="#010202" stroke-width="3"
                        stroke-miterlimit="1" d="M67.5,144.031
            l0.043-24.795c0-2.074-1.82-3.602-4.066-3.602c-2.247,0-4.068,1.529-4.068,3.602v18.834" />
                    <path id="left_middle_finger" fill="#FFFFFF" stroke="#010202" stroke-width="3"
                        stroke-miterlimit="1" d="M59.374,138.074
            v-22.436c0-2.074-1.82-3.604-4.066-3.604l0,0c-2.247,0-4.068,1.529-4.068,3.604v22.435" />
                    <path id="left_ring_finger" fill="#FFFFFF" stroke="#010202" stroke-width="3"
                        stroke-miterlimit="1" d="M51.239,138.071v-18.833
            c0-2.074-1.821-3.604-4.067-3.604l0,0c-2.247,0-4.067,1.53-4.067,3.604v18.833" />
                </g>
                <g id="right_hand">
                    <path fill="#FFFFFF" stroke="#010202" stroke-width="3" stroke-miterlimit="1" d="M128.177,168.001v-4l-12.364-28.163
            c-0.995-2.087-1.27-3.829,0.319-5.413s4.185-2.049,5.867,0.729l5.317,8.847v-4h24.362V123.69c0-2.076,1.821-3.759,4.067-3.759
            c2.247,0,4.067,1.683,4.067,3.759v20.341l-0.001,0.001V152l-6.327,16" />
                    <path fill="#FFFFFF" stroke="#010202" stroke-width="3" stroke-miterlimit="1"
                        d="M135.408,138.039v-18.833" />
                    <path id="right_index_finger" fill="#FFFFFF" stroke="#010202" stroke-width="3"
                        stroke-miterlimit="1" d="M135.408,138.07
            v-18.834c0-2.072-1.821-3.602-4.068-3.602c-2.246,0-4.066,1.527-4.066,3.602l0.043,24.795" />
                    <path id="right_middle_finger" fill="#FFFFFF" stroke="#010202" stroke-width="3"
                        stroke-miterlimit="1" d="M143.577,138.073
            v-22.435c0-2.074-1.821-3.604-4.068-3.604l0,0c-2.246,0-4.066,1.529-4.066,3.604v22.436" />
                    <path id="right_ring_finger" fill="#FFFFFF" stroke="#010202" stroke-width="3"
                        stroke-miterlimit="1" d="M151.712,138.071
            v-18.833c0-2.073-1.82-3.604-4.067-3.604l0,0c-2.246,0-4.067,1.529-4.067,3.604v18.833" />
                </g>
            </g>
        </svg>
    </div>

    <!-- Snake (Right Side) -->
    <div class="organic-shape right-4 sm:right-8 md:right-16 top-1/2 transform -translate-y-1/2">
        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="350" height="350" viewBox="0 0 24 24">
            <path
                d="M17.622 3c-1.913 0-2.558 1.382-5.623 1.382-3.009 0-3.746-1.382-5.623-1.382-5.209 0-6.376 10.375-6.376 14.348 0 2.145.817 3.652 2.469 3.652 3.458 0 2.926-5 6.915-5h5.23c3.989 0 3.457 5 6.915 5 1.652 0 2.471-1.506 2.471-3.651 0-3.973-1.169-14.349-6.378-14.349zm-10.622 10c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3-1.343 3-3 3zm10-6c.552 0 1 .447 1 1 0 .553-.448 1-1 1s-1-.447-1-1c0-.553.448-1 1-1zm-2 4c-.552 0-1-.447-1-1 0-.553.448-1 1-1s1 .447 1 1c0 .553-.448 1-1 1zm2 2c-.552 0-1-.447-1-1 0-.553.448-1 1-1s1 .447 1 1c0 .553-.448 1-1 1zm2-2c-.552 0-1-.447-1-1 0-.553.448-1 1-1s1 .447 1 1c0 .553-.448 1-1 1zm-10.25-1c0 .965-.785 1.75-1.75 1.75s-1.75-.785-1.75-1.75.785-1.75 1.75-1.75 1.75.785 1.75 1.75z">
            </path>
        </svg>
    </div>

    <!-- Wave Bottom -->
    <div class="wave-bottom">
        <section class="{{-- text-gray-700 --}} bg-white fixed bottom-0 w-full {{-- body-font fixed bottom-0 w-full --}}" {!! $attributes ?? '' !!}>
            {{-- <div class="container flex flex-col items-center px-8 py-8 mx-auto max-w-7xl sm:flex-row">
                <a href="#_" class="text-xl font-black leading-none text-white select-none logo">tails<span
                        class="text-indigo-600">.</span></a>
                <p class="mt-4 text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l sm:border-gray-200 sm:mt-0">&copy;
                    2021
                    Tails - Tailwindcss Page Builder
                </p>
                <span class="inline-flex justify-center mt-4 space-x-5 sm:ml-auto sm:mt-0 sm:justify-start">
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Facebook</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>

                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Instagram</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>

                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Twitter</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>

                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">GitHub</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>

                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Dribbble</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </span>
            </div> --}}
            <div class="max-w-screen-xl px-4 py-12 mx-auto space-y-8 overflow-hidden sm:px-6 lg:px-8">
                <nav class="flex flex-wrap justify-center -mx-5 -my-2">
                    <div class="px-5 py-2">
                        <a href="#" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                            API Docs
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="#" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                            Community
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="#" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                            Support
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="#" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                            Terms
                        </a>
                    </div>
                    <div class="px-5 py-2">
                        <a href="#" class="text-base leading-6 text-gray-500 hover:text-gray-900">
                            Privacy
                        </a>
                    </div>
                </nav>
                <div class="flex justify-center mt-8 space-x-6">
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Facebook</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Instagram</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Twitter</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">GitHub</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                <p class="mt-8 text-base leading-6 text-center text-gray-500">
                    &copy; 2024 Arabhardware Developers. All rights reserved.
                </p>
            </div>
        </section>
    </div>




</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https:////cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }

    // Add subtle animations on scroll
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const cactus = document.querySelector('.cactus').parentElement;
        const snake = document.querySelector('.snake').parentElement;

        cactus.style.transform = `translateY(${scrolled * 0.1}px)`;
        snake.style.transform = `translateY(${scrolled * -0.1}px)`;
    });

    // Add hover effects to decorative elements
    document.querySelectorAll('.organic-shape').forEach(shape => {
        shape.addEventListener('mouseenter', () => {
            shape.style.transform += ' scale(1.05)';
            shape.style.transition = 'transform 0.3s ease';
        });

        shape.addEventListener('mouseleave', () => {
            shape.style.transform = shape.style.transform.replace(' scale(1.05)', '');
        });
    });

    var svg = $('#hands-svg');
    svg.setActive = false;

    var svgHands = function (element) {
        var
            select = function (e) {
                return document.querySelector(e);
            },
            hands = select('#hands'),
            left_hand = select('#left_hand'),
            right_hand = select('#right_hand'),
            left_index_finger = select("#left_index_finger"),
            left_middle_finger = select("#left_middle_finger"),
            left_ring_finger = select("#left_ring_finger"),
            right_index_finger = select("#right_index_finger"),
            right_middle_finger = select("#right_middle_finger"),
            right_ring_finger = select("#right_ring_finger");

        var tl_lh = new TimelineLite();
        tl_lh
            .add(
                TweenMax.set(
                    [left_index_finger, left_middle_finger, left_ring_finger], {
                    transformOrigin: "50% 100%"
                }),
                TweenMax.set(
                    left_hand, {
                    transformOrigin: "50% 100%",
                    x: 0,
                    y: 0
                })
            )
            .add(TweenMax.to(left_hand, 0.5, {
                y: -10
            }, 0))
            .add(TweenMax.to(left_index_finger, 0.15, {
                scaleY: 0.8
            }))
            .add(TweenMax.to(left_index_finger, 0.15, {
                scaleY: 1
            }))
            .add(TweenMax.to(left_hand, 0.2, {
                y: -20,
                x: -10
            }))
            .add(TweenMax.to(left_middle_finger, 0.15, {
                scaleY: 0.8
            }))
            .add(TweenMax.to(left_middle_finger, 0.15, {
                scaleY: 1
            }))
            .add(TweenMax.to(left_hand, 0.1, {
                y: -24,
                x: 24
            }))
            .add(TweenMax.to(left_middle_finger, 0.15, {
                scaleY: 0.8
            }))
            .add(TweenMax.to(left_middle_finger, 0.15, {
                scaleY: 1
            }))
            .add(TweenMax.to(left_ring_finger, 0.15, {
                scaleY: 0.8
            }))
            .add(TweenMax.to(left_ring_finger, 0.15, {
                scaleY: 1
            }))
            .add(TweenMax.to(left_hand, 0.5, {
                x: 0,
                y: 0
            }, 0));

        var tl_rh = new TimelineLite();

        tl_rh
            .add(
                TweenMax.set(
                    [right_index_finger, right_middle_finger, right_ring_finger], {
                    transformOrigin: "50% 100%"
                }),
                TweenMax.set(
                    right_hand, {
                    transformOrigin: "50% 100%",
                    x: 0,
                    y: 0
                })
            )
            .add(TweenMax.to(right_hand, 0.5, {
                y: -10
            }, 0))
            .add(TweenMax.to(right_index_finger, 0.15, {
                scaleY: 0.8
            }))
            .add(TweenMax.to(right_index_finger, 0.15, {
                scaleY: 1
            }))
            .add(TweenMax.to(right_hand, 0.2, {
                y: -20,
                x: -10
            }))
            .add(TweenMax.to(right_middle_finger, 0.15, {
                scaleY: 0.8
            }))
            .add(TweenMax.to(right_middle_finger, 0.15, {
                scaleY: 1
            }))
            .add(TweenMax.to(right_hand, 0.1, {
                y: -24,
                x: 12
            }))
            .add(TweenMax.to(right_middle_finger, 0.15, {
                scaleY: 0.8
            }))
            .add(TweenMax.to(right_middle_finger, 0.15, {
                scaleY: 1
            }))
            .add(TweenMax.to(right_ring_finger, 0.15, {
                scaleY: 0.8
            }))
            .add(TweenMax.to(right_ring_finger, 0.15, {
                scaleY: 1
            }))
            .add(TweenMax.to(right_hand, 0.5, {
                x: 0,
                y: 0
            }, 0));

        var timeline = new TimelineLite({
            onComplete: function () {
                svg.setActive = false
            }
        });

        timeline.append(tl_lh).append(tl_rh, -2);

        timeline.pause().progress();

        return timeline;
    }

    svg.on("mouseenter", function () {
        if (svg.setActive == false) {
            svg.setActive = true;
            svgHands().play();
        }
        return svg.setActive = true;
    });
</script>

</body>

</html>