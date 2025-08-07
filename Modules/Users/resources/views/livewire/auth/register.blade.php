<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('users::components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $phone = '';
    public string $phone_key = '+20';
    public ?string $from = null;
    public array $phone_keys = [
        ['id' => '+20', 'name' => 'Egypt (+20)'],
        ['id' => '+1', 'name' => 'United States (+1)'],
        ['id' => '+44', 'name' => 'United Kingdom (+44)'],
        ['id' => '+49', 'name' => 'Germany (+49)'],
        ['id' => '+33', 'name' => 'France (+33)'],
        ['id' => '+91', 'name' => 'India (+91)'],
        ['id' => '+81', 'name' => 'Japan (+81)'],
        ['id' => '+61', 'name' => 'Australia (+61)'],
        ['id' => '+86', 'name' => 'China (+86)'],
        ['id' => '+7', 'name' => 'Russia (+7)'],
        ['id' => '+39', 'name' => 'Italy (+39)'],
        ['id' => '+34', 'name' => 'Spain (+34)'],
        ['id' => '+55', 'name' => 'Brazil (+55)'],
        ['id' => '+27', 'name' => 'South Africa (+27)'],
        ['id' => '+82', 'name' => 'South Korea (+82)'],
        ['id' => '+66', 'name' => 'Thailand (+66)'],
        ['id' => '+60', 'name' => 'Malaysia (+60)'],
        ['id' => '+62', 'name' => 'Indonesia (+62)'],
        ['id' => '+63', 'name' => 'Philippines (+63)'],
        ['id' => '+351', 'name' => 'Portugal (+351)'],
        ['id' => '+34', 'name' => 'Spain (+34)'],
        ['id' => '+90', 'name' => 'Turkey (+90)'],
        ['id' => '+31', 'name' => 'Netherlands (+31)'],
        ['id' => '+32', 'name' => 'Belgium (+32)'],
        ['id' => '+41', 'name' => 'Switzerland (+41)'],

    ];

    public function mount()
    {
        $this->from = request('from') ?? null;
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        if ($this->from == 'developers'){
            $this->redirectIntended(default: route('developers.apps', absolute: false), navigate: false);
        } else {
            $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
        }
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <input type="hidden" wire:model="from" value="{{ request('from') }}">
        <!-- Name -->
        <x-mary-input :label="__('Name')" wire:model="name" placeholder="{{ __('Full name') }}" inline clearable
            required autofocus autocomplete="name" />

        <!-- Email Address -->
        <x-mary-input :label="__('Email address')" type="email" wire:model="email" placeholder="email@example.com" inline clearable
            required autocomplete="email" />

        <x-mary-input :label="__('Phone')" wire:model="phone" inline required>
            <x-slot:prepend>
                <x-mary-select icon="o-phone" wire:model="phone_key" :options="$phone_keys" class="join-item {{-- bg-base-200 --}}" />
            </x-slot:prepend>
        </x-mary-input>

        <!-- Password -->
        <x-mary-password :label="__('Password')" wire:model="password" :placeholder="__('Password')" password-icon="o-lock-closed"
            password-visible-icon="o-lock-open" inline right required autocomplete="current-password" />

        <!-- Confirm Password -->
        <x-mary-password :label="__('Confirm Password')" wire:model="password_confirmation" :placeholder="__('Confirm Password')" password-icon="o-lock-closed"
            password-visible-icon="o-lock-open" inline right required autocomplete="new-password" />

         <div class="flex items-center justify-end">
            <x-mary-button label="{{ __('Create account') }}" type="submit" wire:click="register" class="w-full btn-primary"
                spinner />
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Already have an account?') }}
        <a href="{{ route('login', array_filter(['from' => $from ?? request('from')])) }}" class="underline" wire:navigate>{{ __('Log in') }}</a>
    </div>



    <div class="divider">or</div>

    <x-users::social-media-login />
</div>
