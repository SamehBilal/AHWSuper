<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('roles::components.layouts.auth')] class extends Component {
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="mt-4 flex flex-col gap-6">
    <small class="text-center">
        {{ __('Please verify your email address by clicking on the link we just emailed to you.') }}
    </small>

    @if (session('status') == 'verification-link-sent')
        <small class="text-center font-medium !dark:text-green-400 !text-green-600">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </small>
    @endif

    <div class="flex flex-col items-center justify-between space-y-3">

        <x-mary-button label="{{ __('Resend verification email') }}" type="submit" wire:click="sendVerification" class="w-full btn-primary"
                spinner />

        <a class="text-sm cursor-pointer underline" wire:click="logout">
            {{ __('Log out') }}
        </a>
    </div>
</div>
