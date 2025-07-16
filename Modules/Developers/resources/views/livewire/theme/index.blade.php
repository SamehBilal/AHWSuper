<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;

new #[Layout('developers::components.layouts.master')] class extends Component {
    use Toast;

    public $pageTitle = 'Arabhardware | Developers';
}; ?>

<x-developers::layouts.master>
    <div>

        <nav class="relative z-20 flex items-center justify-between px-4 sm:px-6 lg:px-8 py-4">
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
                {{-- <h1 x-data="{
                    startingAnimation: { opacity: 0, y: 50, rotation: '25deg' },
                    endingAnimation: { opacity: 1, y: 0, rotation: '0deg', stagger: 0.02, duration: 0.7, ease: 'back' },
                    addCNDScript: true,
                    splitCharactersIntoSpans(element) {
                        text = element.innerHTML;
                        modifiedHTML = [];
                        for (var i = 0; i < text.length; i++) {
                            attributes = '';
                            if(text[i].trim()){ attributes = 'class=\'inline-block\''; }
                            modifiedHTML.push('<span ' + attributes + '>' + text[i] + '</span>');
                        }
                        element.innerHTML = modifiedHTML.join('');
                    },

                    addScriptToHead(url) {
                        script = document.createElement('script');
                        script.src = url;
                        document.head.appendChild(script);
                    },
                    animateText() {
                        $el.classList.remove('invisible');
                        gsap.fromTo($el.children, this.startingAnimation, this.endingAnimation);
                    }
                }"
                x-init="
                    splitCharactersIntoSpans($el);
                    if(addCNDScript){
                        addScriptToHead('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js');
                    }
                    gsapInterval2 = setInterval(function(){
                        if(typeof gsap !== 'undefined'){
                            animateText();
                            clearInterval(gsapInterval2);
                        }
                    }, 5);
                "
                class="invisible block pb-0.5 overflow-hidden text-3xl font-bold custom-font"
                >
                Pines UI Library
                </h1> --}}
                <h2 x-data="{
                    startingAnimation: { opacity: 0, y: 50, rotation: '25deg' },
                    endingAnimation: { opacity: 1, y: 0, rotation: '0deg', stagger: 0.02, duration: 0.7, ease: 'back' },
                    addCNDScript: true,
                    splitCharactersIntoSpans(element) {
                        text = element.innerHTML;
                        modifiedHTML = [];
                        for (var i = 0; i < text.length; i++) {
                            attributes = '';
                            if(text[i].trim()){ attributes = 'class=\'inline-block\''; }
                            modifiedHTML.push('<span ' + attributes + '>' + text[i] + '</span>');
                        }
                        element.innerHTML = modifiedHTML.join('');
                    },

                    addScriptToHead(url) {
                        script = document.createElement('script');
                        script.src = url;
                        document.head.appendChild(script);
                    },
                    animateText() {
                        $el.classList.remove('invisible');
                        gsap.fromTo($el.children, this.startingAnimation, this.endingAnimation);
                    }
                }"
                x-init="
                    splitCharactersIntoSpans($el);
                    if(addCNDScript){
                        addScriptToHead('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js');
                    }
                    gsapInterval2 = setInterval(function(){
                        if(typeof gsap !== 'undefined'){
                            animateText();
                            clearInterval(gsapInterval2);
                        }
                    }, 5);
                " class="invisible block pb-0.5 overflow-hidden text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-amber-50 mb-6 leading-tight">
                    Start Building Today
                </h2>
                <p class="text-lg sm:text-xl md:text-2xl text-amber-50 mb-8 max-w-2xl mx-auto">
                    Tools and APIs to power your next app.
                </p>

                <!-- CTA Button with Arrows -->
                <div class="relative inline-block">
                    <!-- Left Arrow -->
                    <span class="arrow {{-- text-white --}}" style="left: -78px; top: 45px;">
                        <svg aria-hidden="true" viewBox="0 0 144 141" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M129.189 0.0490494C128.744 0.119441 126.422 0.377545 124.03 0.635648C114.719 1.6446 109.23 2.4893 108.058 3.09936C107.119 3.56864 106.674 4.34295 106.674 5.44576C106.674 6.71281 107.424 7.51058 109.043 7.97986C110.403 8.37875 110.825 8.42567 118.87 9.52847C121.778 9.92736 124.288 10.3028 124.475 10.3732C124.663 10.4436 122.951 11.1006 120.676 11.8749C110.028 15.4414 100.412 20.7677 91.7339 27.9242C88.38 30.7164 81.6957 37.4271 79.2096 40.5009C73.8387 47.2116 69.6874 54.8139 66.5681 63.7302C65.9348 65.4665 65.3484 66.8978 65.2546 66.8978C65.1374 66.8978 63.7771 66.7336 62.2291 66.5693C52.9649 65.5134 43.1847 68.1649 34.1316 74.2186C24.7735 80.46 18.5349 87.7338 10.5371 101.742C2.53943 115.726 -1.0959 127.482 0.287874 135.014C0.89767 138.463 2.0469 140.035 3.97011 140.082C5.28352 140.105 5.37733 139.659 4.20465 139.049C3.05541 138.463 2.6567 137.9 2.32835 136.281C0.616228 128.021 6.24512 113.028 17.4325 96.1104C23.2725 87.241 28.362 81.9147 35.5622 77.1046C43.8649 71.5437 52.7069 69.033 61.1737 69.8308C64.9967 70.1828 64.6917 69.9247 64.1992 72.4822C62.2525 82.5013 63.8005 92.6378 67.9753 97.354C73.1116 103.079 81.9771 102 85.0027 95.2657C86.3395 92.2858 86.3864 87.7103 85.1434 83.9796C83.1498 78.0901 80.007 73.8197 75.4335 70.8163C73.8152 69.7604 70.4848 68.1883 69.875 68.1883C69.359 68.1883 69.4294 67.6487 70.2268 65.3257C72.3377 59.2486 75.457 52.7021 78.4122 48.244C83.2436 40.9232 91.4524 32.5701 99.1687 27.103C105.806 22.4102 113.241 18.5386 120.512 16.0045C123.772 14.8548 129.87 13.1889 130.081 13.3766C130.128 13.447 129.541 14.362 128.791 15.4414C124.78 21.0258 122.716 26.0706 122.388 30.998C122.224 33.7198 122.341 34.588 122.88 34.2595C122.998 34.1891 123.678 32.969 124.405 31.5611C126.281 27.8069 131.722 20.6738 139.579 11.6402C141.127 9.85697 142.652 7.86254 143.027 7.08823C144.552 4.03792 143.52 1.48035 140.377 0.471397C139.439 0.166366 138.102 0.0490408 134.584 0.0255769C132.074 -0.021351 129.635 0.00212153 129.189 0.0490494ZM137.117 4.92955C137.187 5.0234 136.718 5.63346 136.061 6.29045L134.865 7.48712L131.042 6.73627C128.931 6.33739 126.727 5.9385 126.14 5.8681C124.827 5.68039 124.123 5.32843 124.968 5.28151C125.296 5.28151 126.868 5.11725 128.486 4.953C131.3 4.64797 136.812 4.62451 137.117 4.92955ZM71.5168 72.5292C76.2075 74.899 79.4441 78.8175 81.3204 84.355C83.6189 91.1361 81.2266 96.8378 76.0433 96.8847C73.3227 96.9082 70.9773 95.2188 69.5936 92.2389C68.2802 89.4232 67.6938 86.5606 67.5765 82.1259C67.4593 78.3248 67.6 76.4242 68.2333 72.7403L68.4912 71.2856L69.359 71.5906C69.8515 71.7548 70.8132 72.1772 71.5168 72.5292Z"
                                fill="currentColor"></path>
                        </svg>
                        <span>do it.</span>
                    </span>

                    <a href="{{ route('developers.dashboard') }}"
                        class="btn btn-ghost btn-xs sm:btn-sm md:btn-md lg:btn-lg xl:btn-xl cursor-pointer  text-xl font-medium tracking-wide text-white  rounded-md bg-neutral-950 hover:bg-neutral-900 " wire:navigate>Get
                        Started</a>
                </div>
            </div>
        </main>

        <!-- Decorative Elements -->
        <!-- Cactus (Left Side) -->
        <div class="organic-shape left-4 sm:left-8 md:left-16 top-1/2 transform -translate-y-1/2">
            {{-- <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="350" height="350" viewBox="0 0 24 24">
                <path
                    d="M17.622 3c-1.913 0-2.558 1.382-5.623 1.382-3.009 0-3.746-1.382-5.623-1.382-5.209 0-6.376 10.375-6.376 14.348 0 2.145.817 3.652 2.469 3.652 3.458 0 2.926-5 6.915-5h5.23c3.989 0 3.457 5 6.915 5 1.652 0 2.471-1.506 2.471-3.651 0-3.973-1.169-14.349-6.378-14.349zm-10.622 10c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3-1.343 3-3 3zm10-6c.552 0 1 .447 1 1 0 .553-.448 1-1 1s-1-.447-1-1c0-.553.448-1 1-1zm-2 4c-.552 0-1-.447-1-1 0-.553.448-1 1-1s1 .447 1 1c0 .553-.448 1-1 1zm2 2c-.552 0-1-.447-1-1 0-.553.448-1 1-1s1 .447 1 1c0 .553-.448 1-1 1zm2-2c-.552 0-1-.447-1-1 0-.553.448-1 1-1s1 .447 1 1c0 .553-.448 1-1 1zm-10.25-1c0 .965-.785 1.75-1.75 1.75s-1.75-.785-1.75-1.75.785-1.75 1.75-1.75 1.75.785 1.75 1.75z">
                </path>
            </svg> --}}

            <div class="page">
                <div class="loading-blurbs">
                    <code class="python">
                        print("<strong>Loading...</strong>")
                    </code>
                    <code class="typescript">
                        console.log("<strong>Loading...</strong>")
                    </code>
                    <code class="ruby">
                        puts "<strong>Loading...</strong>"
                    </code>
                    <code class="csharp">System.Console.WriteLine("<strong>Loading...</strong>");
                    </code>
                    <code class="cplusplus">
                        std::cout &lt;&lt; "<strong>Loading...</strong>" &lt;&lt; std::endl;
                    </code>
                    <code class="java">
                        System.out.println("<strong>Loading...</strong>");
                    </code>
                    <code class="swift">
                        println("<strong>Loading...</strong>")
                    </code>
                    <code class="php">
                        echo "<strong>Loading...</strong>"
                    </code>
                </div>
            </div>


        </div>

        <!-- Snake (Right Side) -->
        <div class="organic-shape right-4 sm:right-8 md:right-16 top-1/2 transform -translate-y-1/2">
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

        <!-- Wave Bottom -->
        <div class="wave-bottom">
            <section class="{{-- text-gray-700 --}} bg-white fixed bottom-0 w-full {{-- body-font fixed bottom-0 w-full --}}"
                {!! $attributes ?? '' !!}>
                <div class="container flex flex-col items-center px-8 py-8 mx-auto max-w-7xl sm:flex-row">
                    <a href="#_"
                        class="text-xl flex space-x-1  font-black leading-none text-white select-none logo"><x-app-logo-icon
                            class="w-8" />
                        {{--  <div class="badge badge-neutral badge-outline mt-1">for developers</div> --}}</a>
                    <p class="mt-4 text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l sm:border-gray-200 sm:mt-0">
                        &copy; {{ date('Y') }} Arabhardware Developers. All rights reserved.
                    </p>
                    <span class="inline-flex justify-center mt-4 space-x-5 sm:ml-auto sm:mt-0 sm:justify-start">
                        <a href="https://www.facebook.com/arabhardware/" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Facebook</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="https://www.instagram.com/arabhardware/?hl=en"
                            class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Instagram</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                        <a href="https://x.com/arabhardware?lang=en" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">X</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <a href="https://www.tiktok.com/@arabhardware?lang=en" class="text-gray-400 hover:text-gray-500">
                            <span class="sr-only">GitHub</span>
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </span>
                </div>
                {{-- <div class="max-w-screen-xl px-4 py-12 mx-auto space-y-8 overflow-hidden sm:px-6 lg:px-8">
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
                </div> --}}
            </section>
        </div>


        <x-cookies />

    </div>
</x-developers::layouts.master>

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

    var svgHands = function(element) {
        var
            select = function(e) {
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
            onComplete: function() {
                svg.setActive = false
            }
        });

        timeline.append(tl_lh).append(tl_rh, -2);

        timeline.pause().progress();

        return timeline;
    }

    // Autoplay on page load
    $(document).ready(function() {
        setTimeout(function() {
            svg.setActive = true;
            var timeline = svgHands();
            timeline.eventCallback("onComplete", function() {
                svg.setActive = false; // Allow mouseenter again
            });
            timeline.play();
        }, 1500); // 2 second delay
    });

    svg.on("mouseenter", function() {
        if (svg.setActive == false) {
            svg.setActive = true;
            var timeline = svgHands();
            timeline.eventCallback("onComplete", function() {
                svg.setActive = false;
            });
            timeline.play();
        }
        return svg.setActive = true;
    });
</script>
