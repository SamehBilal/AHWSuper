<?php

use Livewire\Volt\Component;

new class extends Component {
    public $user;
    public $apps;

    public function mount()
    {
        $this->user = Auth::user();
        $this->loadApps($this->user);
    }

    public function loadApps($user)
    {
        $this->apps = $user->developerApps()->get();
    }
}; ?>

<div class="card border border-dashed bg-base-100 border-base-content/10 border-b-[length:var(--border)] p-4">
    <div class="flex items-center w-full gap-4">
        <!-- Welcome -->
        <div class="flex items-center w-1/2">
            <div class="relative">
                <div class="avatar">
                    <div class="w-14 rounded-full">
                        <img src="https://avatar.iran.liara.run/public" />
                    </div>
                </div>
                <div class="absolute -bottom-1 -right-1 avatar">
                    <div class="w-6 rounded-full">
                        <img src="https://flagcdn.com/eg.svg" />
                    </div>
                </div>
            </div>
            <div class="ml-4">
                <div class="font-bold text-lg">Welcome back, {{ $user->name }}</div>
                <div class="text-sm opacity-80">It's nice to see you again</div>
            </div>
        </div>

        <div class="flex w-1/2 items-center justify-between">
            <!-- Tasks -->
            <div class="text-center">
                <div class="flex items-baseline justify-center space-x-2">
                    <p class="text-4xl font-bold">{{ $apps->count() }}</p>
                    <p class="text-xl">App(s)</p>
                </div>
                <p class="text-sm opacity-80">Are currently in your wallet</p>
            </div>

            <!-- CTA -->
            <x-mary-card class=" bg-primary text-neutral-content ">
                <p>Start using our team and project management tools</p>
                <a href="/api/docs" class="link font-bold">Learn More</a>
                <div class="absolute bottom-2 right-2 text-neutral-content">
                    <x-mary-icon name="o-document" class="w-7 h-7  opacity-20" />
                </div>
            </x-mary-card>
        </div>
    </div>
</div>
