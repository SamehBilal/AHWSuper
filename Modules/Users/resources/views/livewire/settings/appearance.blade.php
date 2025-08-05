<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[Layout('users::components.layouts.admin', ['pageTitle' => 'Arabhardware | Users Management'])] class extends Component {
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
}; ?>

<section class="w-full">
    @include('users::partials.settings-heading')

    <x-users::settings.layout :heading="__('Appearance')" :subheading="__('Update the appearance settings for your account')">
        <div class="grid grid-cols-4 w-full gap-4">
            @foreach ($themes as $themeKey => $themeData)

                    <div class="relative">
                        <div class="absolute inset-0 flex flex-row items-center justify-center gap-1 pointer-events-none z-1">
                            <x-mary-icon :name="$themeData['icon']" class="w-5 h-5" />
                            <span class="text-xs font-medium">{{ $themeData['name'] }}</span>
                        </div>

                        <input type="radio" name="theme-buttons"
                               class="btn theme-controller w-full h-10 relative" value="{{ $themeKey }}" />
                    </div>
            @endforeach

        </div>
    </x-users::settings.layout>
</section>
