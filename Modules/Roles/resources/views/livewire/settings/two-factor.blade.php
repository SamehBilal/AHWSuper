<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use PragmaRX\Recovery\Recovery;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

new class extends Component {
    public $secret;
    public $qrCodeUrl;
    public $showingQrCode = false;
    public $showingRecoveryCodes = false;
    public $recoveryCodes = [];
    public $code;
    public function mount()
    {
        $google2fa = app('pragmarx.google2fa');

        $user = Auth::user();
        $this->secret = $user->two_factor_secret;
        $this->recoveryCodes = $user->two_factor_recovery_codes;
        if (!$this->secret) {
            $this->secret = $google2fa->generateSecretKey();
            $this->recoveryCodes = (new Recovery())->toJson();
            //$this->qrCodeUrl = $google2fa->getQRCodeInline(config('app.name'), $user->email, $this->secret);
            $qrCodeText = $google2fa->getQRCodeUrl(
                config('app.name'),
                $user->email,
                $this->secret
            );

            $this->qrCodeUrl = $this->generateQrCodeDataUri($qrCodeText);
        }
    }

    private function generateQrCodeDataUri($text)
    {
        $qrCode = new QrCode($text);

        $writer = new PngWriter();
        $result = $writer->write($qrCode);

        return $result->getDataUri();
    }


    public function toggleQrCode()
    {
        $this->showingQrCode = !$this->showingQrCode;
    }

    public function toggleRecoveryCodes()
    {
        $this->showingRecoveryCodes = !$this->showingRecoveryCodes;
    }

    public function enableTwoFactor()
    {
        $google2fa = app('pragmarx.google2fa');
        $this->validate([
            'code' => [
                'required',
                'digits:6',
                function ($attribute, $value, $fail) use ($google2fa) {
                    if (!$google2fa->verifyKey($this->secret, $value)) {
                        $fail(__('The :attribute is invalid.'));
                    }
                },
            ],
        ]);

        $user = Auth::user();
        $user->two_factor_secret = $this->secret;
        $user->two_factor_recovery_codes = $this->recoveryCodes;
        $user->two_factor_confirmed_at = now();
        $user->save();

        $this->dispatch('done', success: 'Two Factor Authentication Enabled');
    }
    public function disableTwoFactor()
    {
        $user = Auth::user();
        $user->two_factor_secret = null;
        $user->two_factor_recovery_codes = null;
        $user->two_factor_confirmed_at = null;
        $user->save();
        $this->dispatch('done', success: 'Two Factor Authentication Disabled');
    }

    public function regenerateRecoveryCodes()
    {
        $user = Auth::user();
        $this->recoveryCodes = (new Recovery())->toJson();
        $user->two_factor_recovery_codes = $this->recoveryCodes;
        $user->save();
        
        $this->showingRecoveryCodes = true;
        $this->dispatch('done', success: 'Recovery codes have been regenerated');
    }
}; ?>

<section class="w-full">
    @include('roles::partials.settings-heading')

    <x-roles::settings.layout :heading="__('Two Factor Authentication')" :subheading="__('Add additional security to your account using two factor authentication.')">
        @if (!Auth::user()->two_factor_secret)
            @if ($showingQrCode)
                <div class="mt-2 space-y-4">
                    <span class="text-md font-semibold">Finish enabling two factor authentication.</span>
                    <p class="text-sm mt-3">To finish enabling two factor authentication, scan the following QR code using your
                        phone's authenticator application or enter the setup key and provide the generated OTP code. </p>

                    <div class="flex justify-start">
                        <img src="{{ $qrCodeUrl }}" alt="QR Code" class="w-50">
                    </div>
                    <p class="text-md font-semibold">Setup key: {{ $secret }}</p>

                    <!-- Code -->
                    <x-mary-input :label="__('Code')" wire:model="code" placeholder="{{ __('Code') }}" inline clearable />

                    <div class="flex items-center gap-4">
                        <x-mary-button label="{{ __('Confirm') }}" wire:click="enableTwoFactor" class="btn-primary" spinner />
                        <x-mary-button label="{{ __('Cancel') }}" wire:click="toggleQrCode" class="btn" />
                    </div>
                </div>
            @else
                <div class="mt-2 space-y-4">
                    <span class="text-md font-semibold">You have not enabled two factor authentication.</span>

                    <p class="text-sm">When two factor authentication is enabled, you will be prompted for a secure, random
                        token during authentication. You may retrieve this token from your phone's Google Authenticator
                        application.</p>

                    <x-mary-button label="{{ __('Enable') }}" wire:click="toggleQrCode" class="btn-primary" spinner />
                </div>
            @endif
        @else
            <div class="mt-2 space-y-4">
                <span class="text-md font-semibold">You have enabled two factor authentication.</span>
                <p class="text-sm mt-3">When two factor authentication is enabled, you will be prompted for a secure, random
                    token during authentication. You may retrieve this token from your phone's Google Authenticator
                    application. </p>
                <p class="text-sm mt-3 font-semibold">Store these recovery codes in a secure password manager. They can be
                    used to recover access to your account if your two factor authentication device is lost. </p>
                <template x-if="$wire.showingRecoveryCodes">
                    <ul class="text-sm mt-3 bg-gray-50 rounded-[8px] p-3 space-y-2 grid grid-row gap-1">
                        @foreach (json_decode($recoveryCodes) as $code)
                            <li class="font-semibold">{{ $code }}</li>
                        @endforeach
                    </ul>
                </template>
                <div class="flex items-center gap-4">
                    @if (!$showingRecoveryCodes)
                        <x-mary-button label="{{ __('Show Recovery Codes') }}" wire:click="toggleRecoveryCodes"
                            class="btn" spinner />
                    @else
                        <x-mary-button label="{{ __('Regenerate Recovery Codes') }}" wire:click="regenerateRecoveryCodes" class="btn" spinner />
                    @endif
                    <x-mary-button label="{{ __('Disable') }}" wire:click="disableTwoFactor" class="btn-primary" spinner />
                </div>
            </div>
        @endif
    </x-roles::settings.layout>
</section>