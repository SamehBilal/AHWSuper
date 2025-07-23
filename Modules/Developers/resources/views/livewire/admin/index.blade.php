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
            <div
                class="card border border-dashed bg-base-100 border-base-content/10 border-b-[length:var(--border)] p-4">
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
        </div>
        <div
            class="col-span-6 row-span-3 border border-dashed bg-base-100 border-base-content/10 border-b-[length:var(--border)] mockup-browser">
            <div class="mockup-browser-toolbar">
                <div class="input">https://arabhardware.net</div>
            </div>
            <div class="place-content-center p-10 w-full border-t border-base-300">
                <div class="flex w-full gap-1 flex-col mb-10 text-center">
                    <div>
                        <x-mary-badge value="Live Demo" class="badge-primary" />
                    </div>

                    <div
                        class="font-medium [:where(&)]:text-zinc-800 [:where(&)]:dark:text-white text-2xl [&:has(+[data-flux-subheading])]:mb-2 [[data-flux-subheading]+&]:mt-2">
                        Arabhardware Social Login Integration
                    </div>
                    <div class="text-sm">Experience seamless authentication with ArabHardware OAuth</div>
                </div>
                <div class="flex place-content-center w-full ">
                    <div class="card bg-base-100 rounded-box grid grow place-items-center">
                        <livewire:partials.admin.login-form :formId="'browser'" />
                    </div>
                    <div class="divider divider-horizontal">OR</div>

                    <div class="card {{-- p-10 --}} grid  grow place-items-center">
                        <div class="col-span-2 mockup-phone ">
                            <div class="mockup-phone-camera"></div>
                            <div class="mockup-phone-display bg-base-100 grid place-content-center">
                                <livewire:partials.admin.login-form :formId="'phone'" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="stats stats-vertical border border-dashed bg-base-100 border-base-content/10 border-b-[length:var(--border)] col-span-2">
            <div class="stat">
                <div class="stat-figure text-primary">
                    <x-mary-icon name="o-arrow-top-right-on-square" class="inline-block h-10 w-10 stroke-current" />
                </div>
                <div class="stat-title">API Requests Today</div>
                <div class="stat-value">4,320</div>
                <div class="stat-desc">As of 2:00 PM</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-primary">
                    <x-mary-icon name="o-exclamation-triangle" class="inline-block h-10 w-10 stroke-current" />
                </div>
                <div class="stat-title">Errors/Incidents This Month</div>
                <div class="stat-value">7</div>
                <div class="stat-desc">Last: 2 days ago</div>
            </div>

            <div class="stat">
                <div class="stat-figure text-primary">
                    <x-mary-icon name="o-speaker-wave" class="inline-block h-10 w-10 stroke-current" />
                </div>
                <div class="stat-title">Pending Approvals/Reviews</div>
                <div class="stat-value">3</div>
                <div class="stat-desc text-primary">Awaiting your action</div>
            </div>
        </div>
        <div class="col-span-2">
            <x-calendar />
        </div>

        <x-mary-card class="col-span-2 bg-primary text-neutral-content  items-center text-center" title="Tip of today!">
            <blockquote>"{{ trim($message) }}"</blockquote>
            <p class="mt-1 font-semibold">{{ trim($author) }}</p>

            <div class="absolute bottom-5 right-5 text-neutral-content">
                <x-mary-icon name="o-trophy" class="w-14 h-14 opacity-20" />
            </div>
        </x-mary-card>



    </div>
</div>
