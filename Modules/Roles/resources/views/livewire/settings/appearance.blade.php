<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<section class="w-full">
    @include('roles::partials.settings-heading')

    <x-roles::settings.layout :heading="__('Appearance')" :subheading=" __('Update the appearance settings for your account')">
        <div class="join join-horizontal">
            <input
              type="radio"
              name="theme-buttons"
              class="btn theme-controller join-item"
              aria-label="Default"
              value="default" />
            <input
              type="radio"
              name="theme-buttons"
              class="btn theme-controller join-item"
              aria-label="Dark"
              value="dark" />
            <input
              type="radio"
              name="theme-buttons"
              class="btn theme-controller join-item"
              aria-label="Bumblebee"
              value="bumblebee" />
            <input
              type="radio"
              name="theme-buttons"
              class="btn theme-controller join-item"
              aria-label="Retro"
              value="retro" />
            <input
              type="radio"
              name="theme-buttons"
              class="btn theme-controller join-item"
              aria-label="Cyberpunk"
              value="cyberpunk" />
            <input
              type="radio"
              name="theme-buttons"
              class="btn theme-controller join-item"
              aria-label="Valentine"
              value="valentine" />
            <input
              type="radio"
              name="theme-buttons"
              class="btn theme-controller join-item"
              aria-label="Aqua"
              value="aqua" />
          </div>
    </x-roles::settings.layout>
</section>
