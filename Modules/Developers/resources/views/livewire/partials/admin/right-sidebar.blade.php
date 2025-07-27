<?php

use Livewire\Volt\Component;

new class extends Component {
   
    public function mount()
    {
        //
    }

}; ?>

<div class="lg:col-span-1 flex flex-col min-h-screen">
    <div class="space-y-6 sticky top-20 ">
        <!-- Quick Start -->
        <x-mary-card
            class="col-span-2 border border-dashed bg-base-100 border-base-content/10 border-b-[length:var(--border)] ">
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
                <a href="#">
                    <x-mary-alert icon="o-document" class="alert-success">
                        API <strong>documentation.</strong>
                        <x-slot:actions>
                            <x-mary-icon name="o-arrow-top-right-on-square"
                                class="inline-block stroke-current" />
                        </x-slot:actions>
                    </x-mary-alert>
                </a>
                <a href="#">
                    <x-mary-alert icon="o-arrow-down-tray" class="alert-info">
                        SDK <strong>download.</strong>
                    </x-mary-alert>
                </a>
            </div>

        </x-mary-card>

        <!-- OAuth Endpoints -->
        <x-mary-card
            class="col-span-2 border border-dashed bg-base-100 border-base-content/10 border-b-[length:var(--border)] ">
            <x-slot:title>
                <h2 class="card-title text-xl flex gap-1 mb-4">
                    <img class="text-red-500 h-8" src="{{ asset('api.webp') }}" alt="">
                    OAuth Endpoints
                </h2>
            </x-slot:title>
            <div class="space-y-3 text-sm">
                <div>
                    <div class="font-medium mb-1">Authorization URL</div>
                    <code
                        class="text-xs alert p-2 rounded block break-all">{{ config('app.url') == 'http://localhost' ? 'http://localhost:8000' : config('app.url') }}/oauth/authorize</code>
                </div>
                <div>
                    <div class="font-medium mb-1">Token URL</div>
                    <code
                        class="text-xs alert p-2 rounded block break-all">{{ config('app.url') == 'http://localhost' ? 'http://localhost:8000' : config('app.url') }}/oauth/token</code>
                </div>
                <div>
                    <div class="font-medium mb-1">User Info</div>
                    <code
                        class="text-xs alert p-2 rounded block break-all">{{ config('app.url') == 'http://localhost' ? 'http://localhost:8000' : config('app.url') }}/user</code>
                </div>
            </div>
        </x-mary-card>


        <!-- Supported Scopes -->
        <x-mary-card
            class="col-span-2 border border-dashed bg-base-100 border-base-content/10 border-b-[length:var(--border)] ">
            <x-slot:title>
                <h2 class="card-title text-xl flex gap-1 mb-4">
                    <img class="text-red-500 h-8" src="{{ asset('scopes.webp') }}" alt="">
                    Supported Scopes
                </h2>
            </x-slot:title>
            <div class="space-y-2 text-sm">
                <div class="flex items-center space-x-2">
                    <x-mary-badge value="profile" class="badge-dash" />
                    <span class="text-gray-600">Basic profile information</span>
                </div>
                <div class="flex items-center space-x-2">
                    <x-mary-badge value="email" class="badge-dash" />
                    <span class="text-gray-600">Email address</span>
                </div>
            </div>
        </x-mary-card>

        <!-- Support -->
        <x-mary-card
            class="col-span-2 bg-primary border border-dashed text-white shadow-lg border-base-content/10 border-b-[length:var(--border)] ">
            <x-slot:title>
                <h2 class="card-title text-xl flex gap-1 mb-4">
                    <img class="text-red-500 h-8" src="{{ asset('magic.webp') }}" alt="">
                    Need Help?
                </h2>
            </x-slot:title>
            <p class="text-sm text-red-100 mb-4">
                Our developer support team is here to help you integrate successfully.
            </p>
            <button
                class="btn w-full btn-outline btn-sm text-white border-white hover:bg-white hover:text-red-500">
                <i class="fas fa-envelope mr-2"></i>
                Contact Support
            </button>
        </x-mary-card>
    </div>
</div>