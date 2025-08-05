<?php

use Livewire\Volt\Component;

new class extends Component {
    public bool $themeModal = false;
    public string $selectedTheme = 'light';

    public array $themes = [
        'light' => ['name' => 'Light', 'icon' => 'o-sun'],
        'dark' => ['name' => 'Dark', 'icon' => 'o-moon'],
        'cupcake' => ['name' => 'Cupcake', 'icon' => 'o-cake'],
        'synthwave' => ['name' => 'Synthwave', 'icon' => 'o-tv'],
        'retro' => ['name' => 'Retro', 'icon' => 'o-camera'],
        'cyberpunk' => ['name' => 'Cyberpunk', 'icon' => 'o-bolt'],
        'aqua' => ['name' => 'Aqua', 'icon' => 'o-eye-dropper'],
        'dracula' => ['name' => 'Dracula', 'icon' => 'c-beaker'],
        'luxury' => ['name' => 'Luxury', 'icon' => 'o-user'],
        'night' => ['name' => 'Night', 'icon' => 'o-moon'],
        'coffee' => ['name' => 'Coffee', 'icon' => 'o-camera'],
        'bumblebee' => ['name' => 'Bumblebee', 'icon' => 'o-bug-ant'],
        'emerald' => ['name' => 'Emerald', 'icon' => 'o-sparkles'],
        'corporate' => ['name' => 'Corporate', 'icon' => 'o-briefcase'],
        'valentine' => ['name' => 'Valentine', 'icon' => 'o-heart'],
        'halloween' => ['name' => 'Halloween', 'icon' => 'o-beaker'],
        'garden' => ['name' => 'Garden', 'icon' => 'o-sun'],
        'forest' => ['name' => 'Forest', 'icon' => 'o-sun'],
        'lofi' => ['name' => 'Lofi', 'icon' => 'o-microphone'],
        'pastel' => ['name' => 'Pastel', 'icon' => 'o-paint-brush'],
        'fantasy' => ['name' => 'Fantasy', 'icon' => 'o-sparkles'],
        'wireframe' => ['name' => 'Wireframe', 'icon' => 'o-briefcase'],
        'black' => ['name' => 'Black', 'icon' => 'o-adjustments-horizontal'],
        'cmyk' => ['name' => 'CMYK', 'icon' => 'o-sparkles'],
        'autumn' => ['name' => 'Autumn', 'icon' => 'o-sun'],
        'business' => ['name' => 'Business', 'icon' => 'o-briefcase'],
        'acid' => ['name' => 'Acid', 'icon' => 'o-beaker'],
        'lemonade' => ['name' => 'Lemonade', 'icon' => 'o-bolt'],
        'winter' => ['name' => 'Winter', 'icon' => 'o-sparkles'],
        'dim' => ['name' => 'Dim', 'icon' => 'o-bug-ant'],
        'nord' => ['name' => 'Nord', 'icon' => 'o-sparkles'],
        'sunset' => ['name' => 'Sunset', 'icon' => 'o-sun'],
        'caramellatte' => ['name' => 'Caramellatte', 'icon' => 'o-sun'],
        'silk' => ['name' => 'Silk', 'icon' => 'o-sun'],
        'abyss' => ['name' => 'Abyss', 'icon' => 'o-sun'],
    ];

    public function mount()
    {
        // Get current theme from localStorage - this will be overridden by Alpine.js
        $this->selectedTheme = 'light';
    }

    public function setTheme($theme)
    {
        $this->selectedTheme = "$theme";
        //$this->themeModal = false;

        // Apply theme and save to localStorage immediately
        $this->js("
            document.documentElement.setAttribute('data-theme', '$theme');
            localStorage.setItem('mary-theme', '$theme');
        ");
    }

    public function closeModal()
    {
        $this->themeModal = false;
    }

    public function openThemeModal()
    {
        $this->themeModal = true;
    }
}; ?>

<div x-data="{
    initTheme() {
            // Get theme from localStorage or default to light
            const savedTheme = localStorage.getItem('mary-theme') || 'light';
            this.applyTheme(savedTheme);
            $wire.selectedTheme = savedTheme;
        },
        applyTheme(theme) {
            // Apply theme to the entire document
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('mary-theme', theme);
        }
}" x-init="initTheme()">

    <!-- Keep modal INSIDE the component - not pushed -->
    <x-mary-modal wire:model="themeModal" title="{{ __('Change Theme') }}"
        subtitle="{{ __('Select a theme for your app appearance.') }}" class="z-[9999]">
        <div class="py-4 space-y-4">
            <div class="grid grid-cols-3 gap-4">
                @foreach ($themes as $themeKey => $themeData)
                    <div class="relative">
                        <div class="absolute inset-0 flex flex-row items-center justify-center gap-1 pointer-events-none z-2">
                            <x-mary-icon :name="$themeData['icon']" class="w-5 h-5" />
                            <span class="text-xs font-medium">{{ $themeData['name'] }}</span>
                        </div>

                        <input type="radio" name="theme-buttons" wire:click="setTheme('{{ $themeKey }}')"
                               class="btn theme-controller w-full h-10 relative" value="{{ $themeKey }}" />
                    </div>
                @endforeach
            </div>
        </div>


        <x-slot:actions>
            <x-mary-button label="{{ __('Cancel') }}" @click="$wire.themeModal = false" />
        </x-slot:actions>
    </x-mary-modal>

    <x-mary-button icon="o-swatch" class="btn btn-circle btn-ghost !w-8 !rounded-lg" @click="$wire.themeModal = true" />

    {{-- <x-mary-popover position="right-start" offset="0">
        <x-slot:trigger>
            <x-mary-menu-item icon="o-swatch" @click="$wire.themeModal = true" />
            <x-mary-button icon="o-swatch" class="btn btn-circle btn-ghost !w-8 !rounded-lg" @click="$wire.themeModal = true" />
        </x-slot:trigger>
        <x-slot:content>
            <div class="grid place-content-center border-t border-base-300">{{ __('Theme') }}</div>
        </x-slot:content>
    </x-mary-popover> --}}
    {{-- <x-mary-theme-toggle class="hidden" /> --}}
</div>
