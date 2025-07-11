<?php

use Livewire\Volt\Component;

new class extends Component {
    public $sessions = [];
    public bool $showConfirmPasswordModal = false;

    public function mount()
    {
        $this->sessions = $this->getSessions();
    }

    public function openConfirmPasswordModal()
    {
        $this->showConfirmPasswordModal = true;
    }

    public function getSessions()
    {
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

        $agent = new \Jenssegers\Agent\Agent();

        return $sessions->map(function ($session) use ($currentSessionId, $agent) {
            $agent->setUserAgent($session->user_agent);
            $deviceType = $agent->isDesktop() ? 'desktop' : ($agent->isTablet() ? 'tablet' : ($agent->isMobile() ? 'mobile' : 'unknown'));
            $os = $agent->platform() ?: 'Unknown OS';
            $browser = $agent->browser() ?: 'Unknown Browser';
            $deviceIcon = match($deviceType) {
                'desktop' => 'o-computer-desktop',
                'tablet' => 'o-device-tablet',
                'mobile' => 'o-device-phone-mobile',
                default => 'o-question-mark-circle',
            };
            return [
                'id' => $session->id,
                'ip_address' => $session->ip_address,
                'user_agent' => $session->user_agent,
                'is_current_device' => $session->id === $currentSessionId,
                'last_active' => \Carbon\Carbon::createFromTimestamp($session->last_activity)->diffForHumans(),
                'os' => $os,
                'browser' => $browser,
                'device_icon' => $deviceIcon,
            ];
        });
    }

    #[\Livewire\Attributes\On('logoutOtherSessions')]
    public function logoutOtherSessions()
    {
        $userId = auth()->id();
        $currentSessionId = session()->getId();

        \DB::table('sessions')
            ->where('user_id', $userId)
            ->where('id', '!=', $currentSessionId)
            ->delete();

        $this->sessions = $this->getSessions();

        $this->dispatch('sessionsUpdated');
    }
}; ?>
<section class="w-full">
    @include('roles::partials.settings-heading')
    <x-roles::settings.layout :heading="__('Browser Sessions')" :subheading=" __('Manage and log out your active sessions on other browsers and devices.')">

        <p class="text-sm">
            If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your
            recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has
            been compromised, you should also update your password.
        </p>
        <div class="mt-5 space-y-6">
            @foreach ($sessions as $session)
                <div class="flex items-center">
                    <div>
                        <x-mary-icon :name="$session['device_icon']" class="w-10 h-10 text-nutural" />
                    </div>
                    <div class="ms-3">
                        <div class="text-sm">
                            {{ $session['os'] }} - {{ $session['browser'] }}
                        </div>
                        <div>
                            <div class="text-xs">
                                {{ $session['ip_address'] ?? 'Unknown IP' }}@if($session['is_current_device']), <span class="font-semibold text-green-400">{{ __('This device') }}</span>@endif
                            </div>
                        </div>
                        <div class="text-xs text-zinc-400">
                            {{ __('Last active') }}: {{ $session['last_active'] }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex mt-8 items-center gap-4">
            <div class="flex items-center justify-end">
                <x-mary-button label="{{ __('Log Out Other Browser Sessions') }}" type="button"
                    wire:click="openConfirmPasswordModal" class="btn-primary" spinner />
            </div>

            <x-action-message class="me-3" on="sessionsUpdated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>

        <livewire:settings.confirm-password :show="$showConfirmPasswordModal" callback="logoutOtherSessions" wire:key="confirm-password-modal" />

    </x-roles::settings.layout>
</section>