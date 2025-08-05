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
        <div class="flex items-center space-x-2">
            <x-mary-badge value="posts" class="badge-dash" />
            <span class="text-gray-600">User's posts and content</span>
        </div>
        <div class="flex items-center space-x-2">
            <x-mary-badge value="comments" class="badge-dash" />
            <span class="text-gray-600">User's comments and replies</span>
        </div>
    </div>
</x-mary-card>
