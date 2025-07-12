<?php

use Livewire\Volt\Component;

new class extends Component {

    public $breadcrumbs;
    public $slides;
    public $pageTitle = 'AHW Store Dashboard';

    public function mount()
    {
        // Set the page title
        $this->pageTitle = 'AHW Store Dashboard';
        
        $this->breadcrumbs = [
            [
                'label' => 'Home',
                'icon' => 'm-home',
                'link' => route('dashboard'),
                'tooltip-left' => 'Tooltips are supported!',
            ],
            [
                'label' => 'Dashboard',
                'tooltip' => 'Default position is top!',
            ],
        ];

        $this->slides = [
            [
                'image' => asset('ahwstores.webp'),
                'title' => 'AHW Store first',
                'description' => 'We love last week frameworks.',
                'url' => '/docs/installation',
                'urlText' => 'Get started',
            ],
            [
                'image' => asset('ahwstores1.webp'),
                'title' => 'Ahw Store second',
                'description' => 'Where burnout is just a fancy term for Tuesday.',
            ],
            [
                'image' => asset('ahwstores2.webp'),
                'title' => 'Ahw Store second',
                'description' => 'Where burnout is just a fancy term for Tuesday.',
            ],
            [
                'image' => asset('ahwstores3.webp'),
                'title' => 'Ahw Store second',
                'description' => 'Where burnout is just a fancy term for Tuesday.',
            ],
            [
                'image' => asset('ahwstores4.webp'),
                'title' => 'Ahw Store second',
                'description' => 'Where burnout is just a fancy term for Tuesday.',
            ],
            [
                'image' => asset('ahwstores5.webp'),
                'title' => 'Ahw Store second',
                'description' => 'Where burnout is just a fancy term for Tuesday.',
            ],
            [
                'image' => asset('ahwstores6.webp'),
                'title' => 'Ahw Store second',
                'description' => 'Where burnout is just a fancy term for Tuesday.',
            ],
        ];
    }

    public function updatedPageTitle()
    {
        $this->dispatch('set-page-title', title: $this->pageTitle);
    }
}; ?>

<x-ahwstore::layouts.master>
    <div wire:init="$dispatch('set-page-title', { title: '{{ $pageTitle }}' })">
        <x-mary-header title="Dashboard" subtitle="AHW store dashboard" separator>
            <x-slot:subtitle>
                <x-mary-breadcrumbs :items="$breadcrumbs" separator="o-slash" separator-class="text-primary"
                    class=" pt-1 rounded-box" icon-class="text-primary" link-item-class="text-sm font-bold" />
            </x-slot:subtitle>
            <x-slot:middle class="!justify-end">
                <x-mary-input icon="o-bolt" placeholder="Search..." />
            </x-slot:middle>
            <x-slot:actions>
                <x-mary-button icon="o-funnel" />
                <x-mary-button icon="o-plus" class="btn-primary" />
            </x-slot:actions>
        </x-mary-header>

        <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
            <div class="grid auto-rows-min gap-4 md:grid-cols-4">
                <x-mary-stat class="border border-neutral-200 dark:border-neutral-700" title="Messages" value="44"
                    icon="o-envelope" tooltip="Hello" color="text-primary" />

                <x-mary-stat class="border border-neutral-200 dark:border-neutral-700" title="Sales"
                    description="This month" value="22.124" icon="o-arrow-trending-up" tooltip-bottom="There" />

                <x-mary-stat class="border border-neutral-200 dark:border-neutral-700" title="Lost"
                    description="This month" value="34" icon="o-arrow-trending-down" tooltip-left="Ops!" />

                <x-mary-stat title="Sales" description="This month" value="22.124" icon="o-arrow-trending-down"
                    class="text-orange-500 border border-neutral-200 dark:border-neutral-700" color="text-pink-500"
                    tooltip-bottom="Gosh!" />
            </div>
            <div class="relative h-full flex-1 overflow-hidden rounded-xl ">
                <x-mary-carousel :slides="$slides" />
            </div>
        </div>
    </div>
</x-ahwstore::layouts.master>