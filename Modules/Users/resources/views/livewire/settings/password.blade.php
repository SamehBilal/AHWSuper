<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;
use Mary\Traits\Toast;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.app', ['pageTitle' => 'Arabhardware | Users Management'])] class extends Component {
    use Toast;

    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');
            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');
        $this->success('Password updated successfully!', position:'bottom-right');
        $this->dispatch('password-updated');

        $this->redirectIntended(default: route('settings.profile', absolute: false), navigate: true);
    }
}; ?>

<section class="w-full">
    @include('users::partials.settings-heading')

    <x-users::settings.layout :heading="__('Update password')" :subheading="__('Ensure your account is using a long, random password to stay secure')">
        <form wire:submit="updatePassword" class="mt-6 space-y-6">

            <!-- Password -->
            <x-mary-password :label="__('Current Password')" wire:model="current_password" :placeholder="__('Current password')" password-icon="o-lock-closed"
            password-visible-icon="o-lock-open" inline right required autocomplete="current-password" />

            <!-- New Password -->
            <x-mary-password :label="__('New Password')" wire:model="password" :placeholder="__('New password')" password-icon="o-lock-closed"
            password-visible-icon="o-lock-open" inline right required autocomplete="new-password" />

            <!-- Confirm Password -->
            <x-mary-password :label="__('Confirm Password')" wire:model="password_confirmation" :placeholder="__('Confirm password')" password-icon="o-lock-closed"
            password-visible-icon="o-lock-open" inline right required autocomplete="new-password" />

            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <x-mary-button label="{{ __('Save') }}" type="submit" wire:click="updatePassword" class="w-full btn-primary"
                        spinner />
                </div>

                <x-action-message class="me-3" on="password-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>
    </x-users::settings.layout>
</section>
