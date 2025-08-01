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
                class="text-xs alert p-2 rounded block break-all">{{ config('app.url') == 'http://localhost' ? 'http://localhost:8000' : config('app.url') }}/oauth/user</code>
        </div>
    </div>
</x-mary-card>
