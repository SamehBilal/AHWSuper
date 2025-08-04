<?php

use Livewire\Volt\Component;

new class extends Component {
    public bool $themeModal = false;
    public string $selectedTheme = 'light';

    public array $themes = [
        'light' => ['name' => 'Light', 'icon' => 'o-sun'],
        'dark' => ['name' => 'Dark', 'icon' => 'o-moon'],
        'midnight' => ['name' => 'Midnight', 'icon' => 'o-star'],
        'cupcake' => ['name' => 'Cupcake', 'icon' => 'o-cake'],
        'synthwave' => ['name' => 'Synthwave', 'icon' => 'o-tv'],
        'retro' => ['name' => 'Retro', 'icon' => 'o-camera'],
        'cyberpunk' => ['name' => 'Cyberpunk', 'icon' => 'o-bolt'],
        'aqua' => ['name' => 'Aqua', 'icon' => 'o-eye-dropper'],
        'dracula' => ['name' => 'Dracula', 'icon' => 'c-beaker'],
        'luxury' => ['name' => 'Luxury', 'icon' => 'o-user'],
        'night' => ['name' => 'Night', 'icon' => 'o-moon'],
        'coffee' => ['name' => 'Coffee', 'icon' => 'o-camera'],
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
        subtitle="{{ __('Select a theme for your app appearance.') }}"
        class="z-[9999]">
        <div class="py-4 space-y-4">
            <div class="grid grid-cols-2 gap-4">
                @foreach ($themes as $themeKey => $themeData)
                    <div class="relative cursor-pointer" wire:click="setTheme('{{ $themeKey }}')">
                        <div class="btn h-10 w-full flex-row gap-2"
                            class="{{ $selectedTheme === $themeKey ? 'btn-primary' : 'btn-outline hover:btn-primary' }}">
                            <input type="radio" name="theme-buttons"  @click="$dispatch('mary-toggle-theme')" {{ $selectedTheme === $themeKey ? 'checked' : '' }}
                                class="btn theme-controller h-20 w-full flex-col gap-2 opacity-0 absolute inset-0"
                                aria-label="{{ $themeData['name'] }}" value="{{ $themeKey }}" />
                            <x-mary-icon :name="$themeData['icon']" class="w-6 h-6" />
                            <span class="text-sm">{{ $themeData['name'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <x-slot:actions>
            <x-mary-button label="{{ __('Cancel') }}" @click="$wire.themeModal = false" />
        </x-slot:actions>
    </x-mary-modal>

    <x-mary-popover position="right-start" offset="0">
        <x-slot:trigger>
            <x-mary-menu-item icon="o-swatch" @click="$wire.themeModal = true" />
        </x-slot:trigger>
        <x-slot:content>
            <div class="grid place-content-center border-t border-base-300">{{ __('Theme') }}</div>
        </x-slot:content>
    </x-mary-popover>
    {{-- <x-mary-theme-toggle class="hidden" /> --}}
</div>
