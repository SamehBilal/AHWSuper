<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('users::components.layouts.auth')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        Password::sendResetLink($this->only('email'));

        session()->flash('status', __('A reset link will be sent if the account exists.'));
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Forgot password')" :description="__('Enter your email to receive a password reset link')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
        <!-- Email Address -->
        <x-mary-input :label="__('Email address')" type="email" wire:model="email" placeholder="email@example.com" inline clearable
            required autofocus autocomplete="email" />

        <div class="flex items-center justify-end">
            <x-mary-button label="{{ __('Email password reset link') }}" type="submit" wire:click="sendPasswordResetLink" class="w-full btn-primary"
                spinner />
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-400">
        {{ __('Or, return to') }}
        <a href="{{ route('login') }}" class="underline" wire:navigate>{{ __('log in') }}</a>
    </div>
</div>
