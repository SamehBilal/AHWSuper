<?php

use Livewire\Volt\Component;

new class extends Component {
    public bool $themeModal = false;
    public string $selectedTheme = 'light';

    public array $themes = [
        'light' => ['name' => 'Light', 'icon' => 'o-sun'],
        'dark' => ['name' => 'Dark', 'icon' => 'o-moon'],
        'midnight' => ['name' => 'Midnight', 'icon' => 'o-moon-stars'],
        'cupcake' => ['name' => 'Cupcake', 'icon' => 'o-cake'],
        'synthwave' => ['name' => 'Synthwave', 'icon' => 'o-tv'],
        'retro' => ['name' => 'Retro', 'icon' => 'o-camera'],
        'cyberpunk' => ['name' => 'Cyberpunk', 'icon' => 'o-bolt'],
        'aqua' => ['name' => 'Aqua', 'icon' => 'o-droplet'],
        'dracula' => ['name' => 'Dracula', 'icon' => 'o-vampire'],
        'luxury' => ['name' => 'Luxury', 'icon' => 'o-crown'],
        'night' => ['name' => 'Night', 'icon' => 'o-moon'],
        'coffee' => ['name' => 'Coffee', 'icon' => 'o-mug-hot']
    ];

    public function mount()
    {
        // Get current theme from localStorage or default to light
        $this->selectedTheme = 'light';
    }

    public function setTheme($theme)
    {
        $this->selectedTheme = $theme;
        $this->themeModal = false;
    }
}; ?>

<section class="mt-10 space-y-6">
    <x-mary-modal wire:model="themeModal" title="{{ __('Change Theme') }}" subtitle="{{ __('Select a theme for your app appearance.') }}">
        <div class="py-4 space-y-4">
            <div class="grid grid-cols-3 gap-3">
                @foreach($themes as $themeKey => $themeData)
                    <div class="relative">
                        <input
                            type="radio"
                            name="theme-buttons-modal"
                            class="btn theme-controller h-20 w-full flex-col gap-2 opacity-0 absolute inset-0"
                            :aria-label="$themeData['name']"
                            value="{{ $themeKey }}"
                            @if($selectedTheme === $themeKey) checked @endif />
                        <div class="btn btn-outline h-20 w-full flex-col gap-2 pointer-events-none">
                            {{-- <x-mary-icon :name="$themeData['icon']" class="w-6 h-6" /> --}}
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
            {{ __('Theme') }}
        </x-slot:content>
    </x-mary-popover>

</section>

