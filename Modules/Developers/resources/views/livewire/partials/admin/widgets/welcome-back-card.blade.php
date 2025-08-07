<?php

use Livewire\Volt\Component;

new class extends Component {
    public $user;
    public $author;
    public $message;
    public $model = [];
    public $link = [];

    public function mount($model=['name' => 'User', 'count' => 1], $link=null)
    {
        $this->model = $model;
        $this->link = $link;
        [$this->message, $this->author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
        $this->user = Auth::user();
    }
}; ?>

<div class="card border border-dashed bg-base-100 border-base-content/10 border-b-[length:var(--border)] p-4">
    <div class="flex items-center w-full gap-4">
        <!-- Welcome -->
        <div class="flex items-center w-1/3">
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

        <div class="flex w-2/3 items-center justify-between">
            <!-- Tasks -->
            <div class="text-center w-2/3">
                <div class="flex items-baseline justify-center space-x-2">
                    <p class="text-4xl font-bold">{{ $model['count'] }}</p>
                    <p class="text-xl">{{ $model['name'] }}(s)</p>
                </div>
                <p class="text-sm opacity-80">Are currently in our system</p>
            </div>

            @if(@$link)
                <!-- CTA -->
                <x-mary-card class=" bg-primary text-neutral-content w-2/3">
                    <p>{{ $link['data'] }}</p>
                    <a href="{{ $link['route'] }}" class="link font-bold">Learn More</a>
                    <div class="absolute bottom-2 right-2 text-neutral-content">
                        <x-mary-icon name="o-document" class="w-7 h-7  opacity-20" />
                    </div>
                </x-mary-card>
            @else
                <x-mary-card class="bg-primary text-neutral-content w-2/3"
                    title="Tip of today!">
                    <blockquote>"{{ trim($message) }}"</blockquote>
                    <p class="mt-1 font-semibold">{{ trim($author) }}</p>

                    <div class="absolute bottom-2 right-2 text-neutral-content">
                        <x-mary-icon name="o-trophy" class="w-7 h-7 opacity-20" />
                    </div>
                </x-mary-card>
            @endif
        </div>
    </div>
</div>
