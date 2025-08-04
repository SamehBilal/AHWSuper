<?php

use Livewire\Volt\Component;

new class extends Component {
    public function mount()
    {
        //
    }
}; ?>

<x-mary-card class="col-span-2 border border-dashed bg-base-100 border-base-content/10 border-b-[length:var(--border)] ">
    <x-slot:title>
        <h2 class="card-title text-xl flex gap-1 mb-4">
            <img class="text-red-500 h-8" src="{{ asset('rocket.webp') }}" alt="">
            Quick Start
        </h2>
    </x-slot:title>
    <div class="space-y-3 flex flex-col ">
        <a href="{{ route('developers.dashboard') }}" wire:navigate>
            <x-mary-alert class="alert-warning" title="Developer Portal" icon="o-home" />
        </a>
        <a href="/api/docs" target="_blank" rel="noopener noreferrer">
            <x-mary-alert icon="o-document" class="alert-success">
                API <strong>documentation.</strong>
                <x-slot:actions>
                    <x-mary-icon name="o-arrow-top-right-on-square" class="inline-block stroke-current" />
                </x-slot:actions>
            </x-mary-alert>
        </a>
        <a href="#">
            <x-mary-alert icon="o-arrow-down-tray" class="alert-info">
                SDK <strong>download.</strong>
                <x-slot:actions>
                    <span class="badge badge-ghost badge-sm">Soon</span>
                    <x-mary-icon name="o-arrow-down-tray" class="inline-block stroke-current" />
                </x-slot:actions>
            </x-mary-alert>
        </a>
    </div>
</x-mary-card>
