<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.app', ['pageTitle' => 'Arabhardware | Users Management'])] class extends Component {
    use Toast;

    public $sessions = [];
    public string $password = '';
    public bool $showConfirmModal = false;

    public function mount()
    {
        $this->sessions = $this->getSessions();
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
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        $userId = auth()->id();
        $currentSessionId = session()->getId();

        \DB::table('sessions')
            ->where('user_id', $userId)
            ->where('id', '!=', $currentSessionId)
            ->delete();

        $this->sessions = $this->getSessions();

        $this->showConfirmModal = false;
        $this->password = '';

        $this->success('Logged out successfully!', position:'bottom-right');
        $this->dispatch('sessionsUpdated');
    }
}; ?>
<section class="w-full">
    @include('users::partials.settings-heading')
    <x-users::settings.layout :heading="__('Browser Sessions')" :subheading=" __('Manage and log out your active sessions on other browsers and devices.')">

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
                @click="$wire.showConfirmModal = true"  class="btn-primary" spinner />
            </div>

            <x-action-message class="me-3" on="sessionsUpdated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>

        <x-mary-modal wire:model="showConfirmModal" :title="__('Log Out Other Browser Sessions')" :subtitle="__('log out your active sessions on other browsers and devices')">
            <x-mary-form wire:submit="logoutOtherSessions" no-separator>
                <x-mary-password :label="__('Password')" wire:model="password" :placeholder="__('Password')" password-icon="o-lock-closed"
                    password-visible-icon="o-lock-open" inline right required autocomplete="current-password" />
                <x-slot:actions>
                    <x-mary-button label="{{ __('Cancel') }}" @click="$wire.showConfirmModal = false" />
                    <x-mary-button label="{{ __('Confirm') }}" class="btn-primary" type="submit" spinner />
                </x-slot:actions>
            </x-mary-form>
        </x-mary-modal>

    </x-users::settings.layout>
</section>
