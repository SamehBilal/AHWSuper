<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('users::components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    public ?string $from = null;

    public function mount()
    {
        $this->from = request('from') ?? null;
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();


        if ($this->from == 'developers'){
            $this->redirectIntended(default: route('developers.apps', absolute: false), navigate: false);
        } else {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
        }
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}; ?>

<div class="flex flex-col gap-6">

    <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-6">
        <input type="hidden" wire:model="from" value="{{ request('from') }}">
        <!-- Email Address -->
        <x-mary-input :label="__('Email address')" type="email" wire:model="email" placeholder="email@example.com" inline clearable
            required autofocus autocomplete="email" />

        <div class="relative">
            <!-- Forgot Password Link -->
            @if (Route::has('password.request'))
                <a class="absolute underline end-0 top-0 text-sm" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Password -->
        <x-mary-password :label="__('Password')" wire:model="password" :placeholder="__('Password')" password-icon="o-lock-closed"
            password-visible-icon="o-lock-open" inline right required autocomplete="current-password" />

        <!-- Remember Me -->
        <x-mary-checkbox :label="__('Remember me for 30 days')" wire:model="remember" />

        <div class="flex items-center justify-end">
            <x-mary-button label="{{ __('Log in') }}" type="submit" wire:click="login" class="w-full btn-primary"
                spinner />
        </div>
    </form>

    <div class="divider">or</div>

    <x-users::social-media-login />

    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            {{ __('First time around here? ') }}
            <a href="{{ route('register', array_filter(['from' => $from ?? request('from')])) }}" class="underline" wire:navigate>{{ __('Sign up') }}</a>
        </div>
    @endif
</div>
