<?php

use Livewire\Volt\Component;

new class extends Component {
public $sessions = [];

public function mount()
{
    $this->sessions = $this->getSessions();
}

public function getSessions()
{
    // Laravel stores sessions in the database or file, depending on config
    // We'll assume database sessions for this example
    $userId = auth()->id();
    $currentSessionId = session()->getId();

    $driver = config('session.driver');
    if ($driver !== 'database') {
        // Only support database driver for now
        return [];
    }

    $sessions = \DB::table('sessions')
        ->where('user_id', $userId)
        ->orderBy('last_activity', 'desc')
        ->get();

    return $sessions->map(function ($session) use ($currentSessionId) {
        return [
            'id' => $session->id,
            'ip_address' => $session->ip_address,
            'user_agent' => $session->user_agent,
            'is_current_device' => $session->id === $currentSessionId,
            'last_active' => \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
        ];
    });
}

public function logoutOtherSessions()
{
    $userId = auth()->id();
    $currentSessionId = session()->getId();

    \DB::table('sessions')
        ->where('user_id', $userId)
        ->where('id', '!=', $currentSessionId)
        ->delete();

    $this->sessions = $this->getSessions();

    $this->dispatch('done', success: 'Logged out of other sessions.');
}
}; ?>
<section class="w-full">
    @include('roles::partials.settings-heading')
    <x-roles::settings.layout :heading="__('Browser Sessions')" :subheading=" __('Manage and log out your active sessions on other browsers and devices.')">

    <p>
        If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.
    </p>
    <div class="space-y-4">
        @foreach ($sessions as $session)
            <div class="flex items-center justify-between p-4 border rounded-lg @if($session['is_current_device']) bg-green-50 dark:bg-green-900/20 @endif">
                <div>
                    <div class="font-medium">
                        {{ $session['ip_address'] ?? 'Unknown IP' }}
                        @if($session['is_current_device'])
                            <span class="ml-2 px-2 py-0.5 text-xs rounded bg-green-500 text-white">{{ __('This device') }}</span>
                        @endif
                    </div>
                    <div class="text-xs text-zinc-500 dark:text-zinc-400">
                        {{ $session['user_agent'] ?? 'Unknown Device' }}
                    </div>
                </div>
                <div class="text-xs text-zinc-400">
                    {{ __('Last active') }}: {{ $session['last_active'] }}
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6 flex justify-end">
        <flux:button variant="primary" wire:click="logoutOtherSessions">
            {{ __('Log Out Other Browser Sessions') }}
        </flux:button>
    </div>
</x-roles::settings.layout>
</section>






