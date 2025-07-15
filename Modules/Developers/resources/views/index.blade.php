<x-developers::layouts.master>
    {{-- <section class="px-6 pb-12 w-full antialiased bg-white">
        <div class="mx-auto max-w-7xl">

            <nav class="relative z-50 h-24 select-none" x-data="{ showMenu: false }">
                <div class="container flex overflow-hidden relative flex-wrap justify-between items-center mx-auto h-24 font-medium border-b border-gray-200 md:overflow-visible lg:justify-center sm:px-4 md:px-2 lg:px-0">
                    <div class="flex justify-start items-center pr-4 w-1/4 h-full">
                        <a href="#_" class="flex items-center py-4 space-x-2 font-extrabold text-white md:py-0">
                            <span class="flex justify-center items-center w-8 h-8 text-white bg-gray-900 rounded-full">
                                <svg class="w-auto h-5 -translate-y-px" viewBox="0 0 69 66" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="m31.2 12.2-3.9 12.3-13.4.5-13.4.5 10.7 7.7L21.8 41l-3.9 12.1c-2.2 6.7-3.8 12.4-3.6 12.5.2.2 5-3 10.6-7.1 5.7-4.1 10.9-7.2 11.5-6.8.6.4 5.3 3.8 10.5 7.5 5.2 3.8 9.6 6.6 9.8 6.4.2-.2-1.4-5.8-3.6-12.5l-3.9-12.2 8.5-6.2c14.7-10.6 14.8-9.6-.4-9.7H44.2L40 12.5C37.7 5.6 35.7 0 35.5 0c-.3 0-2.2 5.5-4.3 12.2Z" fill="currentColor"/></svg>
                            </span>
                            <span>LOGO</span>
                        </a>
                    </div>
                    <div class="hidden top-0 left-0 items-start p-4 w-full h-full text-sm bg-gray-900 bg-opacity-50 md:items-center md:w-3/4 md:absolute lg:text-base md:bg-transparent md:p-0 md:relative md:flex" :class="{'flex fixed': showMenu, 'hidden': !showMenu }">
                        <div class="overflow-hidden flex-col w-full h-auto bg-white rounded-lg md:bg-transparent md:overflow-visible md:rounded-none md:relative md:flex md:flex-row">
                            <a href="#_" class="block inline-flex items-center px-6 w-auto h-16 text-xl font-black leading-none text-white md:hidden">
                                <svg class="w-auto h-5" viewBox="0 0 355 99" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><path d="M119.1 87V66.4h19.8c34.3 0 34.2-49.5 0-49.5-11 0-22 .1-33 .1v70h13.2zm19.8-32.7h-19.8V29.5h19.8c16.8 0 16.9 24.8 0 24.8zm32.6-30.5c0 9.5 14.4 9.5 14.4 0s-14.4-9.5-14.4 0zM184.8 87V37.5h-12.2V87h12.2zm22.8 0V61.8c0-7.5 5.1-13.8 12.6-13.8 7.8 0 11.9 5.7 11.9 13.2V87h12.2V61.1c0-15.5-9.3-24.2-20.9-24.2-6.2 0-11.2 2.5-16.2 7.4l-.8-6.7h-10.9V87h12.1zm72.1 1.3c7.5 0 16-2.6 21.2-8l-7.8-7.7c-2.8 2.9-8.7 4.6-13.2 4.6-8.6 0-13.9-4.4-14.7-10.5h38.5c1.9-20.3-8.4-30.5-24.9-30.5-16 0-26.2 10.8-26.2 25.8 0 15.8 10.1 26.3 27.1 26.3zM292 56.6h-26.6c1.8-6.4 7.2-9.6 13.8-9.6 7 0 12 3.2 12.8 9.6zm41.2 32.1c14.1 0 21.2-7.5 21.2-16.2 0-13.1-11.8-15.2-21.1-15.8-6.3-.4-9.2-2.2-9.2-5.4 0-3.1 3.2-4.9 9-4.9 4.7 0 8.7 1.1 12.2 4.4l6.8-8c-5.7-5-11.5-6.5-19.2-6.5-9 0-20.8 4-20.8 15.4 0 11.2 11.1 14.6 20.4 15.3 7 .4 9.8 1.8 9.8 5.2 0 3.6-4.3 6-8.9 5.9-5.5-.1-13.5-3-17-6.9l-6 8.7c7.2 7.5 15 8.8 22.8 8.8z" id="a"></path></defs><g fill="none" fill-rule="evenodd"><g fill="currentColor"><path d="M19.742 49h28.516L68 83H0l19.742-34z"></path><path d="M26 69h14v30H26V69zM4 50L33.127 0 63 50H4z"></path></g><g fill-rule="nonzero"><use fill="currentColor" xlink:href="#a"></use><use fill="currentColor" xlink:href="#a"></use></g></g></svg>
                            </a>
                            <div class="flex flex-col justify-center items-start space-x-6 w-full text-center lg:space-x-8 md:w-2/3 md:mt-0 md:flex-row md:items-center">
                                <a href="#_" class="inline-block py-2 mx-0 ml-6 w-full font-medium text-left text-black md:ml-0 md:w-auto md:px-0 md:mx-2 lg:mx-3 md:text-center">Home</a>
                                <a href="#_" class="inline-block py-2 mx-0 w-full font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 hover:text-black lg:mx-3 md:text-center">Features</a>
                                <a href="#_" class="inline-block py-2 mx-0 w-full font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 hover:text-black lg:mx-3 md:text-center">Blog</a>
                                <a href="#_" class="inline-block py-2 mx-0 w-full font-medium text-left text-gray-700 md:w-auto md:px-0 md:mx-2 hover:text-black lg:mx-3 md:text-center">Contact</a>
                                <a href="#_" class="hidden absolute top-0 left-0 py-2 mt-6 mr-2 ml-10 text-gray-600 lg:inline-block md:mt-0 md:ml-2 lg:mx-3 md:relative">
                                    <svg class="inline w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                </a>
                            </div>
                            <div class="flex flex-col justify-end items-start pt-4 w-full md:items-center md:w-1/3 md:flex-row md:py-0">
                                <a href="#" class="px-6 py-2 mr-0 w-full text-gray-700 md:px-3 md:mr-2 lg:mr-3 md:w-auto">Sign In</a>
                                <a href="#_" class="inline-flex items-center px-5 px-6 py-3 w-full text-sm font-medium leading-4 text-white bg-gray-900 md:w-auto md:rounded-full hover:bg-gray-800 focus:outline-none md:focus:ring-2 focus:ring-0 focus:ring-offset-2 focus:ring-gray-800">Sign Up</a>
                            </div>
                        </div>
                    </div>
                    <div @click="showMenu = !showMenu" class="flex absolute right-0 flex-col justify-center items-end items-center w-10 h-10 bg-white rounded-full cursor-pointer md:hidden hover:bg-gray-100">
                        <svg class="w-6 h-6 text-gray-700" x-show="!showMenu" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        <svg class="w-6 h-6 text-gray-700" x-show="showMenu" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </div>
                </div>
            </nav>

            <!-- Main Hero Content -->
            <div class="container py-32 mx-auto mt-px max-w-sm text-left sm:max-w-md md:max-w-lg sm:px-4 md:max-w-none md:text-center">
                <h1 class="text-3xl font-bold tracking-tight leading-10 text-left text-white md:text-center sm:text-4xl md:text-7xl lg:text-8xl">Start Crafting Your <br class="hidden sm:block"> Next Great Idea</h1>
                <div class="mx-auto mt-5 text-gray-400 md:mt-8 md:max-w-lg md:text-center md:text-xl">Simplifying the creation of landing pages, blog pages, application pages and so much more!</div>
                <div class="flex flex-col justify-center items-center mt-8 space-y-4 text-center sm:flex-row sm:space-y-0 sm:space-x-4">
                    <span class="inline-flex relative w-full md:w-auto">
                        <a href="#_" class="inline-flex justify-center items-center px-8 py-4 w-full text-base font-medium leading-6 text-white bg-gray-900 rounded-full border border-transparent xl:px-10 md:w-auto hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800">
                            Purchase Now
                        </a>
                    </span>
                    <span class="inline-flex relative w-full md:w-auto">
                        <a href="#_" class="inline-flex justify-center items-center px-8 py-4 w-full text-base font-medium leading-6 text-white bg-gray-100 rounded-full border border-transparent xl:px-10 md:w-auto hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200">Learn More</a>
                    </span>
                </div>
            </div>
            <!-- End Main Hero Content -->

        </div>
    </section>
    <section class="h-auto bg-white">
        <div class="px-10 py-24 mx-auto max-w-7xl">
            <div class="w-full mx-auto text-left md:text-center">
                <h1 class="mb-6 text-5xl font-extrabold leading-none max-w-5xl mx-auto tracking-normal text-white sm:text-6xl md:text-6xl lg:text-7xl md:tracking-tight"> The <span class="w-full text-transparent bg-clip-text bg-gradient-to-r from-green-400 via-blue-500 to-purple-500 lg:inline">Number One Source</span> for<br class="lg:block hidden"> all your design needs. </h1>
                <p class="px-0 mb-6 text-lg text-gray-600 md:text-xl lg:px-24"> Say hello to the number one source for all your design needs. Drag and drop designs, edit designs, and modify the components to help tell your story. </p>
            </div>
        </div>
    </section>
    <section class="py-20 bg-gray-50">
        <div class="container items-center max-w-6xl px-4 px-10 mx-auto sm:px-20 md:px-32 lg:px-16">
          <div class="flex flex-wrap items-center -mx-3">
            <div class="order-1 w-full px-3 lg:w-1/2 lg:order-0">
              <div class="w-full lg:max-w-md">
                <h2 class="mb-4 text-3xl font-bold leading-tight tracking-tight sm:text-4xl font-heading">Jam-packed with all the tools you need to succeed!</h2>
                <p class="mb-4 font-medium tracking-tight text-gray-400 xl:mb-6">It's never been easier to build a business of your own. Our tools will help you with the following:</p>
                <ul>
                  <li class="flex items-center py-2 space-x-4 xl:py-3">
                    <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                    <span class="font-medium text-gray-500">Faster Processing and Delivery</span>
                  </li>
                  <li class="flex items-center py-2 space-x-4 xl:py-3">
                    <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <span class="font-medium text-gray-500">Out of the Box Tracking and Monitoring</span>
                  </li>
                  <li class="flex items-center py-2 space-x-4 xl:py-3">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    <span class="font-medium text-gray-500">100% Protection and Security for Your App</span>
                  </li>
                </ul>
              </div>
            </div>
            <div class="w-full px-3 mb-12 lg:w-1/2 order-0 lg:order-1 lg:mb-0"><img class="mx-auto sm:max-w-sm lg:max-w-full" src="https://cdn.devdojo.com/images/november2020/feature-graphic.png" alt="feature image"></div>
          </div>
        </div>
      </section>
      <section class="text-gray-700 bg-white body-font" {!! $attributes ?? '' !!}>
        <div class="container flex flex-col items-center px-8 py-8 mx-auto max-w-7xl sm:flex-row">
            <a href="#_" class="text-xl font-black leading-none text-white select-none logo">tails<span class="text-indigo-600">.</span></a>
            <p class="mt-4 text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l sm:border-gray-200 sm:mt-0">&copy; 2021 Tails - Tailwindcss Page Builder
            </p>
            <span class="inline-flex justify-center mt-4 space-x-5 sm:ml-auto sm:mt-0 sm:justify-start">
                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Facebook</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                    </svg>
                </a>

                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Instagram</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                    </svg>
                </a>

                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Twitter</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                    </svg>
                </a>

                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">GitHub</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                    </svg>
                </a>

                <a href="#" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Dribbble</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z" clip-rule="evenodd" />
                    </svg>
                </a>
            </span>
        </div>
    </section> --}}

    <nav class="relative z-20 flex items-center justify-between px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex items-center">
            <h1 class="text-2xl font-bold text-gray-900">tails</h1>
        </div>

        <div class="hidden md:flex items-center space-x-8">
            <a href="#" class="text-gray-900 hover:text-gray-700 font-medium transition-colors">Home</a>
            <a href="#" class="text-gray-900 hover:text-gray-700 font-medium transition-colors">Features</a>
            <a href="#" class="text-gray-900 hover:text-gray-700 font-medium transition-colors">Pricing</a>
            <a href="#" class="text-gray-900 hover:text-gray-700 font-medium transition-colors">Blog</a>
        </div>

        <div class="flex items-center space-x-4">
            <button class="text-gray-900 hover:text-gray-700 font-medium transition-colors">Login</button>
            <button class="bg-gray-900 text-white px-6 py-2 rounded-lg hover:bg-gray-800 transition-colors font-medium">Sign up</button>
        </div>

        <!-- Mobile menu button -->
        <button class="md:hidden p-2" onclick="toggleMobileMenu()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </nav>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-yellow-400 px-4 py-2 relative z-20">
        <div class="flex flex-col space-y-2">
            <a href="#" class="text-gray-900 hover:text-gray-700 font-medium py-2">Home</a>
            <a href="#" class="text-gray-900 hover:text-gray-700 font-medium py-2">Features</a>
            <a href="#" class="text-gray-900 hover:text-gray-700 font-medium py-2">Pricing</a>
            <a href="#" class="text-gray-900 hover:text-gray-700 font-medium py-2">Blog</a>
        </div>
    </div>

    <!-- Main Content -->
    <main class="relative z-10 flex flex-col items-center justify-center min-h-[calc(100vh-80px)] px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="text-center max-w-4xl mx-auto">
            <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 mb-6 leading-tight">
                Create Your Story
            </h2>
            <p class="text-lg sm:text-xl md:text-2xl text-gray-800 mb-8 max-w-2xl mx-auto">
                Designs that help you tell you story.
            </p>

            <!-- CTA Button with Arrows -->
            <div class="relative inline-block">
                <!-- Left Arrow -->
                <div class="arrow" style="left: -120px; top: 25px;"></div>

                <!-- Right Arrow Accent -->
                <div class="arrow-accent" style="right: -100px; top: 35px;"></div>
                <div class="arrow-accent" style="right: -110px; top: 25px;"></div>

                <button class="bg-gray-900 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-800 transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Buy Now - $4
                </button>
            </div>
        </div>
    </main>

    <!-- Decorative Elements -->
    <!-- Cactus (Left Side) -->
    <div class="organic-shape left-4 sm:left-8 md:left-16 top-1/2 transform -translate-y-1/2">
        <div class="cactus w-16 h-32 sm:w-20 sm:h-40 md:w-24 md:h-48">
            <!-- Cactus dots -->
            <div class="cactus-dot" style="top: 10px; left: 8px;"></div>
            <div class="cactus-dot" style="top: 25px; right: 8px;"></div>
            <div class="cactus-dot" style="top: 40px; left: 12px;"></div>
            <div class="cactus-dot" style="top: 55px; right: 6px;"></div>
            <div class="cactus-dot" style="top: 70px; left: 6px;"></div>
            <div class="cactus-dot" style="top: 85px; right: 10px;"></div>
            <div class="cactus-dot" style="top: 100px; left: 14px;"></div>
            <div class="cactus-dot" style="top: 115px; right: 8px;"></div>
        </div>
    </div>

    <!-- Snake (Right Side) -->
    <div class="organic-shape right-4 sm:right-8 md:right-16 top-1/2 transform -translate-y-1/2">
        <div class="snake w-32 h-80 sm:w-40 sm:h-96 md:w-48 md:h-[28rem]" style="border-radius: 50px 50px 20px 20px;">
            <!-- Snake dots -->
            <div class="snake-dot" style="top: 20px; left: 20px;"></div>
            <div class="snake-dot" style="top: 40px; right: 25px;"></div>
            <div class="snake-dot" style="top: 60px; left: 30px;"></div>
            <div class="snake-dot" style="top: 80px; right: 20px;"></div>
            <div class="snake-dot" style="top: 100px; left: 25px;"></div>
            <div class="snake-dot" style="top: 120px; right: 30px;"></div>
            <div class="snake-dot" style="top: 140px; left: 35px;"></div>
            <div class="snake-dot" style="top: 160px; right: 25px;"></div>
            <div class="snake-dot" style="top: 180px; left: 20px;"></div>
            <div class="snake-dot" style="top: 200px; right: 35px;"></div>
            <div class="snake-dot" style="top: 220px; left: 30px;"></div>
            <div class="snake-dot" style="top: 240px; right: 20px;"></div>
            <div class="snake-dot" style="top: 260px; left: 25px;"></div>
            <div class="snake-dot" style="top: 280px; right: 30px;"></div>
        </div>
    </div>

    <!-- Wave Bottom -->
    <div class="wave-bottom"></div>

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
    </script>

</x-developers::layouts.master>
