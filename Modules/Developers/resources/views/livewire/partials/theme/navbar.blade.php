<!-- Desktop menu -->
<nav class="{{ @$class }} relative z-20 flex items-center justify-between px-4 sm:px-6 lg:px-8 py-4">
    <div class="flex md:flex space-x-8 items-center">
        <a href="{{ route('developers.index') }}" class="text-2xl flex space-x-1  font-bold text-gray-900" wire:navigate>
            @if(@$class == 'bg-base-100')
                <x-app-logo-icon  class="w-8"  />
            @else
                <x-app-logo-icon white class="w-8"  />
            @endif
            <div class="badge badge-neutral badge-outline mt-1">for developers</div>
        </a>
        <div class="hidden md:flex items-center space-x-8">
            <a href="/api/docs" class="{{ @$class == 'bg-base-100' ? 'text-nutural hover:text-grey-700':'text-amber-50 hover:text-grey-700' }} font-medium transition-colors">API</a>
            <a href="#" class="{{ @$class == 'bg-base-100' ? 'text-nutural hover:text-grey-700':'text-amber-50 hover:text-grey-700' }} font-medium transition-colors">Docs</a>
            <a href="#" class="{{ @$class == 'bg-base-100' ? 'text-nutural hover:text-grey-700':'text-amber-50 hover:text-grey-700' }} font-medium transition-colors">Community</a>
        </div>
    </div>

    <div class="hidden md:flex items-center space-x-4">
        @guest
            <a href="{{ route('login', ['from' => 'developers']) }}"
                class="{{ @$class == 'bg-base-100' ? 'text-nutural hover:text-grey-700':'text-amber-50 hover:text-grey-700' }} font-medium transition-colors cursor-pointer">Sign In</a>
            <a href="{{ route('register', ['from' => 'developers']) }}"
                class="btn btn-ghost btn-sm sm:btn-sm md:btn-md lg:btn-md xl:btn-md  cursor-pointer text-sm font-medium tracking-wide text-white  rounded-md bg-neutral-950 hover:bg-neutral-900 ">Join Now</a>
        @else
            <a href="{{ route('developers.dashboard') }}"
                class="btn btn-ghost btn-sm sm:btn-sm md:btn-md lg:btn-md xl:btn-md  cursor-pointer text-sm font-medium tracking-wide text-white  rounded-md bg-neutral-950 hover:bg-neutral-900 ">Dashboard</a>
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
<div id="mobile-menu" class="hidden md:hidden {{ @$class }} px-4 py-2 absolute w-full z-20 transition-all duration-300 transform opacity-0 -translate-y-4">
    <div class="flex flex-col space-y-2">
        <a href="/api/docs" class="{{ @$class == 'bg-base-100' ? 'text-nutural hover:text-grey-700':'text-amber-50 hover:text-grey-700' }} font-medium py-2">API</a>
        <a href="#" class="{{ @$class == 'bg-base-100' ? 'text-nutural hover:text-grey-700':'text-amber-50 hover:text-grey-700' }} font-medium py-2">Docs</a>
        <a href="#" class="{{ @$class == 'bg-base-100' ? 'text-nutural hover:text-grey-700':'text-amber-50 hover:text-grey-700' }} font-medium py-2">Community</a>
        <div class="border-t border-gray-700 my-2"></div>
        @guest
            <a href="{{ route('login', ['from' => 'developers']) }}" class="{{ @$class == 'bg-base-100' ? 'text-nutural hover:text-grey-700':'text-amber-50 hover:text-grey-700' }} font-medium py-2">Sign In</a>
            <a href="{{ route('register', ['from' => 'developers']) }}" class="btn btn-ghost btn-sm w-full text-sm font-medium tracking-wide text-white rounded-md bg-neutral-950 hover:bg-neutral-900 py-2">Join Now</a>
        @else
            <a href="{{ route('developers.dashboard') }}" class="btn btn-ghost btn-sm w-full text-sm font-medium tracking-wide text-white rounded-md bg-neutral-950 hover:bg-neutral-900 py-2">Dashboard</a>
        @endguest
    </div>
</div>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        if (!menu.classList.contains('hidden')) {
            menu.classList.remove('opacity-100', 'translate-y-0');
            menu.classList.add('opacity-0', '-translate-y-4');
            setTimeout(() => {
                menu.classList.add('hidden');
            }, 300); // match duration-300
        } else {
            menu.classList.remove('hidden');
            void menu.offsetWidth;
            menu.classList.remove('opacity-0', '-translate-y-4');
            menu.classList.add('opacity-100', 'translate-y-0');
        }
    }
</script>
