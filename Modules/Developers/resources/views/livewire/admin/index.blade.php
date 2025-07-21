<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;

new #[Layout('developers::components.layouts.admin')] class extends Component {
    use Toast;
    public $author;
    public $message;
    public $user;
    public $clients;
    public $pageTitle = 'Arabhardware | Developers';

    public function mount()
    {
        [$this->message, $this->author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
        $this->user = Auth::user();
        $this->loadClients($this->user);
    }

    public function loadClients($user)
    {
        $this->clients = $user->oauthApps()->get();
    }
}; ?>

<div>
    <!-- Dashboard Cards -->
    <div class="grid grid-cols-8 gap-x-8 gap-y-4 mt-5 min-h-[300px]">
        <div class="col-span-8">
            <div class="card border p-4">
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
                                <p class="text-4xl font-bold">{{ $clients->count() }}</p>
                                <p class="text-xl">Apps</p>
                            </div>
                            <p class="text-sm opacity-80">Are currently in your wallet</p>
                        </div>

                        <!-- CTA -->
                        <x-mary-card class=" bg-primary text-neutral-content ">
                            <p>Start using our team and project management tools</p>
                            <a href="#" class="link font-bold">Learn More</a>
                            <div class="absolute bottom-2 right-2 text-neutral-content">
                                <x-mary-icon name="o-document" class="w-8 h-8  opacity-20" />
                            </div>
                        </x-mary-card>
                    </div>
                </div>
            </div>
        </div>
        <x-mary-card class="col-span-2 bg-primary text-neutral-content  items-center text-center" title="Tip of today!">
            <blockquote>"{{ trim($message) }}"</blockquote>
            <p class="mt-1 font-semibold">{{ trim($author) }}</p>

            <div class="absolute bottom-5 right-5 text-neutral-content">
                <x-mary-icon name="o-trophy" class="w-20 h-20  opacity-20" />
            </div>
        </x-mary-card>
        <div>
            <x-calendar />
        </div>
    </div>
</div>
