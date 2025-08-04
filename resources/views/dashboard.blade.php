@php
    $breadcrumbs = [
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

    $slides = [
        [
            'image' => asset('store.png'),
            'title' => 'AHW Store first',
            'description' => 'We love last week frameworks.',
            /* 'url' => '/#',
            'urlText' => 'Get started', */
        ],
        [
            'image' => asset('ahwstores1.png'),
            'title' => 'Ahw Store second',
            'description' => 'Where burnout is just a fancy term for Tuesday.',
        ],
    ];

@endphp
<x-layouts.app :title="__('Arabhardware | Dashboard')">

    <x-mary-header title="Dashboard" {{-- subtitle="AHW store dashboard" --}} separator>
        <x-slot:subtitle>
            <x-mary-breadcrumbs
    :items="$breadcrumbs"
    separator="o-slash"
    separator-class="text-primary"
    class=" pt-1 rounded-box"
    icon-class="text-primary"
    link-item-class="text-sm font-bold"/>
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

            <x-mary-stat class="border border-neutral-200 dark:border-neutral-700" title="Sales" description="This month"
                value="22.124" icon="o-arrow-trending-up" tooltip-bottom="There" />

            <x-mary-stat class="border border-neutral-200 dark:border-neutral-700" title="Lost"
                description="This month" value="34" icon="o-arrow-trending-down" tooltip-left="Ops!" />

            <x-mary-stat title="Sales" description="This month" value="22.124" icon="o-arrow-trending-down"
                class="text-orange-500 border border-neutral-200 dark:border-neutral-700" color="text-pink-500"
                tooltip-bottom="Gosh!" />
        </div>
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl ">
            {{-- <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" /> --}}
            <x-mary-carousel :slides="$slides" />
        </div>
    </div>

</x-layouts.app>
