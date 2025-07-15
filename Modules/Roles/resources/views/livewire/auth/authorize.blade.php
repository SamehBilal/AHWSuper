<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('roles::components.layouts.auth')] class extends Component {
    public $client;
    public $user;
    public $scopes;
    public $state;
    public $clientId;
    public $authToken;

    public function mount($client, $user, $scopes, $request, $authToken = null)
    {
        $this->client = $client;
        $this->user = $user;
        $this->scopes = $scopes;
        $this->state = $request->state;
        $this->clientId = $client->getKey();
        $this->authToken = $authToken;
    }

    /**
     * Approve the authorization request.
     */
    public function approve(): void
    {
        $this->redirect(route('passport.authorizations.approve', [
            'state' => $this->state,
            'client_id' => $this->clientId,
            'auth_token' => $this->authToken,
        ]));
    }

    /**
     * Deny the authorization request.
     */
    public function deny(): void
    {
        $this->redirect(route('passport.authorizations.deny', [
            'state' => $this->state,
            'client_id' => $this->clientId,
            'auth_token' => $this->authToken,
        ]));
    }
}; ?>

<div class="flex flex-col gap-6">

    <x-auth-header 
        :title="__('Authorization Request')" 
        :description="__('An application is requesting access to your account')" 
    />

    <div class="bg-white dark:bg-zinc-800 rounded-lg border border-zinc-200 dark:border-zinc-700 p-6">
        <!-- Client Information -->
        <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-lg text-zinc-900 dark:text-zinc-100">
                    {{ $client->name }}
                </h3>
                <p class="text-sm text-zinc-600 dark:text-zinc-400">
                    {{ __('is requesting access to your account') }}
                </p>
            </div>
        </div>

        <!-- User Information -->
        <div class="mb-6 p-4 bg-zinc-50 dark:bg-zinc-700 rounded-lg">
            <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-1">
                {{ __('You are logged in as:') }}
            </p>
            <p class="font-medium text-zinc-900 dark:text-zinc-100">
                {{ $user->name }} ({{ $user->email }})
            </p>
        </div>

        <!-- Scopes/Permissions -->
        @if (count($scopes) > 0)
            <div class="mb-6">
                <h4 class="font-medium text-zinc-900 dark:text-zinc-100 mb-3">
                    {{ __('This application will be able to:') }}
                </h4>
                <ul class="space-y-2">
                    @foreach ($scopes as $scope)
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-sm text-zinc-700 dark:text-zinc-300">
                                {{ $scope->description }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Warning -->
        <div class="mb-6 p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-lg">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-amber-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z" />
                </svg>
                <div>
                    <p class="text-sm font-medium text-amber-800 dark:text-amber-200">
                        {{ __('Review permissions carefully') }}
                    </p>
                    <p class="text-sm text-amber-700 dark:text-amber-300">
                        {{ __('Only authorize this application if you trust it and understand what access you are granting.') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-3">
            <x-mary-button 
                label="{{ __('Authorize') }}" 
                wire:click="approve"
                class="flex-1 btn-primary"
                spinner 
            />
            <x-mary-button 
                label="{{ __('Cancel') }}" 
                wire:click="deny"
                class="flex-1 btn-outline"
                spinner 
            />
        </div>
    </div>

    <!-- Additional Information -->
    <div class="text-center">
        <p class="text-xs text-zinc-500 dark:text-zinc-400">
            {{ __('Not you?') }} 
            <a href="{{ route('logout') }}" class="underline hover:text-zinc-700 dark:hover:text-zinc-200">
                {{ __('Sign out and login as a different user') }}
            </a>
        </p>
    </div>
</div>