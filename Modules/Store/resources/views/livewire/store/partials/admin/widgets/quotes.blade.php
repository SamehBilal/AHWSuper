<?php

use Livewire\Volt\Component;

new class extends Component {
    public $author;
    public $message;

    public function mount()
    {
        [$this->message, $this->author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
    }
}; ?>

<x-mary-card class="bg-primary text-neutral-content col-span-2 items-center text-center" title="Tip of today!">
    <blockquote>"{{ trim($message) }}"</blockquote>
    <p class="mt-1 font-semibold">{{ trim($author) }}</p>

    <div class="absolute bottom-5 right-5 text-neutral-content">
        <x-mary-icon name="o-trophy" class="w-14 h-14 opacity-20" />
    </div>
</x-mary-card>
