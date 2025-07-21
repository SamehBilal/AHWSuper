<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;

new #[Layout('developers::components.layouts.master', ['navbarClass' => 'bg-primary'])] class extends Component {
    use Toast;

    public $pageTitle = 'Arabhardware | Developers';
}; ?>

<div class="wave-bottom-border min-h-[75vh]">

    <!-- Main Content -->
    <main class="relative z-10 flex flex-col items-center justify-center min-h-[calc(100vh-260px)] px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="text-center max-w-4xl mx-auto">

            <h2 x-data="{
                startingAnimation: { opacity: 0, y: 50, rotation: '25deg' },
                endingAnimation: { opacity: 1, y: 0, rotation: '0deg', stagger: 0.02, duration: 0.7, ease: 'back' },
                addCNDScript: true,
                splitCharactersIntoSpans(element) {
                    text = element.innerHTML;
                    modifiedHTML = [];
                    for (var i = 0; i < text.length; i++) {
                        attributes = '';
                        if (text[i].trim()) { attributes = 'class=\'inline-block\''; }
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
            }" x-init="splitCharactersIntoSpans($el);
            if (addCNDScript) {
                addScriptToHead('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.5/gsap.min.js');
            }
            gsapInterval2 = setInterval(function() {
                if (typeof gsap !== 'undefined') {
                    animateText();
                    clearInterval(gsapInterval2);
                }
            }, 5);"
                class="invisible block pb-0.5 overflow-hidden text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-amber-50 mb-3 sm:mb-6 leading-tight">
                Start Building Today
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl text-amber-50 mb-8 max-w-2xl mx-auto">
                Tools and APIs to power your next app.
            </p>

            <!-- CTA Button with Arrows -->
            <div class="relative inline-block">
                <!-- Left Arrow -->
                <span class="absolute w-[60px] h-[3px] -rotate-[15deg]" style="left: -78px; top: 45px;">
                    <svg aria-hidden="true" viewBox="0 0 144 141" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M129.189 0.0490494C128.744 0.119441 126.422 0.377545 124.03 0.635648C114.719 1.6446 109.23 2.4893 108.058 3.09936C107.119 3.56864 106.674 4.34295 106.674 5.44576C106.674 6.71281 107.424 7.51058 109.043 7.97986C110.403 8.37875 110.825 8.42567 118.87 9.52847C121.778 9.92736 124.288 10.3028 124.475 10.3732C124.663 10.4436 122.951 11.1006 120.676 11.8749C110.028 15.4414 100.412 20.7677 91.7339 27.9242C88.38 30.7164 81.6957 37.4271 79.2096 40.5009C73.8387 47.2116 69.6874 54.8139 66.5681 63.7302C65.9348 65.4665 65.3484 66.8978 65.2546 66.8978C65.1374 66.8978 63.7771 66.7336 62.2291 66.5693C52.9649 65.5134 43.1847 68.1649 34.1316 74.2186C24.7735 80.46 18.5349 87.7338 10.5371 101.742C2.53943 115.726 -1.0959 127.482 0.287874 135.014C0.89767 138.463 2.0469 140.035 3.97011 140.082C5.28352 140.105 5.37733 139.659 4.20465 139.049C3.05541 138.463 2.6567 137.9 2.32835 136.281C0.616228 128.021 6.24512 113.028 17.4325 96.1104C23.2725 87.241 28.362 81.9147 35.5622 77.1046C43.8649 71.5437 52.7069 69.033 61.1737 69.8308C64.9967 70.1828 64.6917 69.9247 64.1992 72.4822C62.2525 82.5013 63.8005 92.6378 67.9753 97.354C73.1116 103.079 81.9771 102 85.0027 95.2657C86.3395 92.2858 86.3864 87.7103 85.1434 83.9796C83.1498 78.0901 80.007 73.8197 75.4335 70.8163C73.8152 69.7604 70.4848 68.1883 69.875 68.1883C69.359 68.1883 69.4294 67.6487 70.2268 65.3257C72.3377 59.2486 75.457 52.7021 78.4122 48.244C83.2436 40.9232 91.4524 32.5701 99.1687 27.103C105.806 22.4102 113.241 18.5386 120.512 16.0045C123.772 14.8548 129.87 13.1889 130.081 13.3766C130.128 13.447 129.541 14.362 128.791 15.4414C124.78 21.0258 122.716 26.0706 122.388 30.998C122.224 33.7198 122.341 34.588 122.88 34.2595C122.998 34.1891 123.678 32.969 124.405 31.5611C126.281 27.8069 131.722 20.6738 139.579 11.6402C141.127 9.85697 142.652 7.86254 143.027 7.08823C144.552 4.03792 143.52 1.48035 140.377 0.471397C139.439 0.166366 138.102 0.0490408 134.584 0.0255769C132.074 -0.021351 129.635 0.00212153 129.189 0.0490494ZM137.117 4.92955C137.187 5.0234 136.718 5.63346 136.061 6.29045L134.865 7.48712L131.042 6.73627C128.931 6.33739 126.727 5.9385 126.14 5.8681C124.827 5.68039 124.123 5.32843 124.968 5.28151C125.296 5.28151 126.868 5.11725 128.486 4.953C131.3 4.64797 136.812 4.62451 137.117 4.92955ZM71.5168 72.5292C76.2075 74.899 79.4441 78.8175 81.3204 84.355C83.6189 91.1361 81.2266 96.8378 76.0433 96.8847C73.3227 96.9082 70.9773 95.2188 69.5936 92.2389C68.2802 89.4232 67.6938 86.5606 67.5765 82.1259C67.4593 78.3248 67.6 76.4242 68.2333 72.7403L68.4912 71.2856L69.359 71.5906C69.8515 71.7548 70.8132 72.1772 71.5168 72.5292Z"
                            fill="currentColor"></path>
                    </svg>
                    <span>do it.</span>
                </span>

                <a href="{{ route('developers.apps') }}"
                    class="btn btn-ghost btn-xs sm:btn-md md:btn-md lg:btn-lg xl:btn-xl cursor-pointer text-xl font-medium tracking-wide text-white rounded-md bg-neutral-950 hover:bg-neutral-900 px-6 py-3 sm:px-8 sm:py-5 " wire:navigate>Get
                    Started</a>
            </div>
        </div>
    </main>

    <!-- (Left Side) -->
    <div class="absolute z-[11] left-4 sm:left-8 md:left-16 top-1/2 -translate-y-1/2 flex justify-center items-center hidden lg:flex lg:w-[300px] xl:w-[400px] 2xl:w-[500px]">
        <div class="flex justify-center items-center" style="color: oklch(14% 0.005 285.823);">
            <div class="w-[150px] lg:w-[300px] xl:w-[400px] 2xl:w-[500px] h-[70px] lg:h-[140px] xl:h-[180px] 2xl:h-[220px] text-center relative loading-blurbs">
                <code class="python">
                    print("<strong>Powered by AHW</strong>")
                </code>
                <code class="typescript">
                    console.log("<strong>Powered by AHW</strong>")
                </code>
                <code class="ruby">
                    puts "<strong>Powered by AHW</strong>"
                </code>
                <code class="csharp">System.Console.WriteLine("<strong>Powered by AHW</strong>");
                </code>
                <code class="cplusplus">
                    std::cout &lt;&lt; "<strong>Powered by AHW</strong>" &lt;&lt; std::endl;
                </code>
                <code class="java">
                    System.out.println("<strong>Powered by AHW</strong>");
                </code>
                <code class="swift">
                    println("<strong>Powered by AHW</strong>")
                </code>
                <code class="php">
                    echo "<strong>Powered by AHW</strong>"
                </code>
            </div>
        </div>
    </div>

    <!-- (Right Side) -->
    <div class="absolute z-[11] right-4 sm:right-8 md:right-16 top-1/2 -translate-y-1/2 hidden lg:block">
        <div class="w-[150px] h-[150px] lg:w-[200px] lg:h-[200px] xl:w-[350px] xl:h-[350px] 2xl:w-[400px] 2xl:h-[400px]">
            <svg id="hands-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px"
                width="100%" height="100%"
                viewBox="0 0 196 196" enable-background="new 0 0 196 196"
                xml:space="preserve">
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
    </div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https:////cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
