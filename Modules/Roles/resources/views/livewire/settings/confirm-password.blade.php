<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component {
    public string $password = '';
    public bool $show = false;
    public ?string $callback = null;
    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        // Instead of redirect, emit event to parent
        $this->dispatch($this->callback ?? 'passwordConfirmed');
        $this->show = false;
        $this->password = '';
    }
}; ?>

<section class="mt-10 space-y-6">
    
    <x-mary-modal wire:model="show" title="{{ __('Confirm Password') }}" subtitle="{{ __('Please enter your password to continue.') }}">

        <x-mary-form wire:submit="confirmPassword" {{-- no- --}}separator>
            <!-- Password -->
            <x-mary-password :label="__('Password')" wire:model="password" :placeholder="__('Password')" password-icon="o-lock-closed"
            password-visible-icon="o-lock-open" inline right required autocomplete="current-password" />

            <x-slot:actions>
                <x-mary-button label="{{ __('Cancel') }}" @click="$wire.show = false" />
                <x-mary-button label="{{ __('Confirm') }}" wire:click='confirmPassword' class="btn-primary" type="submit" spinner />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>

</section>
