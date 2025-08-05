<?php

/* use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component; */

//new #[Layout('users::components.layouts.auth')] class extends Component {
    /* public $client;
    public $user;
    public $scopes;
    public $state;
    public $clientId;
    public $authToken; */

    /* public function mount($client, $user, $scopes, $request, $authToken = null)
    {
        $this->client = $client;
        $this->user = $user;
        $this->scopes = $scopes;
        $this->state = $request->state;
        $this->clientId = $client->getKey();
        $this->authToken = $authToken;
    } */

    /**
     * Approve the authorization request.
     */
    /* public function approve(): void
    {
        $this->redirect(route('passport.authorizations.approve', [
            'state' => $this->state,
            'client_id' => $this->clientId,
            'auth_token' => $this->authToken,
        ]));
    } */

    /**
     * Deny the authorization request.
     */
    /* public function deny(): void
    {
        $this->redirect(route('passport.authorizations.deny', [
            'state' => $this->state,
            'client_id' => $this->clientId,
            'auth_token' => $this->authToken,
        ]));
    } */
//};
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
    <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
        <div class="bg-muted relative hidden h-full flex-col p-10 text-white lg:flex dark:border-e dark:border-neutral-800">
            <div class="absolute inset-0 bg-neutral-900 split-bg" style="background-image: url('{{ asset('build-users/img/auth_aurora_2x.png') }}')"></div>
            <a href="{{ route('home') }}" class="relative z-20 flex items-center text-lg font-medium">
                <span class="flex h-10 w-10 items-center justify-center rounded-md">
                    <x-app-logo-icon class="me-2 fill-current text-white" />
                </span>
                {{ config('app.name', 'Arabhardware') }}
            </a>
            @php
                [$message, $author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
            @endphp
            <div class="relative z-20 mt-auto">
                <blockquote class="space-y-2">
                    <div class="font-medium text-base">&ldquo;{{ trim($message) }}&rdquo;</div>
                    <footer><div class="font-medium text-sm">{{ trim($author) }}</div></footer>
                </blockquote>
            </div>
        </div>
        <div class="w-full lg:p-8">
            <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                <div class="absolute top-4 right-4 z-30">
                    <x-mary-theme-toggle class="btn btn-circle" />
                </div>
                <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden">
                    <span class="flex h-9 w-9 items-center justify-center rounded-md">
                        <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                    </span>
                    <span class="sr-only">{{ config('app.name', 'Arabhardware') }}</span>
                </a>
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
                        <!-- Action Buttons as Forms -->
                        <div class="flex gap-3">
                            <!-- Approve Form -->
                            <form method="POST" action="{{ route('passport.authorizations.approve') }}" class="flex-1">
                                @csrf
                                <input type="hidden" name="state" value="{{ $state ?? request('state') }}">
                                <input type="hidden" name="client_id" value="{{ $clientId ?? $client->getKey() }}">
                                <input type="hidden" name="auth_token" value="{{ $authToken ?? '' }}">
                                <button type="submit" class="w-full btn btn-primary">
                                    {{ __('Authorize') }}
                                </button>
                            </form>
                            <!-- Deny Form -->
                            <form method="POST" action="{{ route('passport.authorizations.deny') }}" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="state" value="{{ $state ?? request('state') }}">
                                <input type="hidden" name="client_id" value="{{ $clientId ?? $client->getKey() }}">
                                <input type="hidden" name="auth_token" value="{{ $authToken ?? '' }}">
                                <button type="submit" class="w-full btn btn-outline">
                                    {{ __('Cancel') }}
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- Additional Information -->
                    <div class="text-center mt-4">
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">
                            {{ __('Not you?') }}
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="underline hover:text-zinc-700 dark:hover:text-zinc-200 bg-transparent border-0 p-0 m-0 cursor-pointer">
                                    {{ __('Sign out and login as a different user') }}
                                </button>
                            </form>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


