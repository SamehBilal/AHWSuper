<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;
use PragmaRX\Recovery\Recovery;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Mary\Traits\Toast;
use Livewire\Attributes\Layout;

new #[Layout('components.layouts.app', ['pageTitle' => 'Arabhardware | Users Management'])] class extends Component {
    use Toast;

    public string $password = '';
    public bool $disableTwoFactorModel = false;
    public $secret;
    public $qrCodeUrl;
    public $showingQrCode = false;
    public $showingRecoveryCodes = false;
    public $recoveryCodes = [];
    public $code;
    public bool $showConfirmModal = false;
    public string $modalAction = '';
    public string $modalHeader = '';
    public string $modalSubheader = '';

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

    public function openConfirmModal($action, $header, $subheader)
    {
        $this->modalAction = $action;
        $this->modalHeader = $header;
        $this->modalSubheader = $subheader;
        $this->showConfirmModal = true;
    }

    public function requestEnableTwoFactor()
    {
        $this->openConfirmModal(
            'enable',
            __('Enable Two Factor Authentication'),
            __('Please confirm your password to enable two factor authentication.')
        );
    }

    public function requestShowRecoveryCodes()
    {
        $this->openConfirmModal(
            'show_recovery',
            __('Show Recovery Codes'),
            __('Please confirm your password to view your recovery codes.')
        );
    }

    public function requestRegenerateRecoveryCodes()
    {
        $this->openConfirmModal(
            'regenerate_recovery',
            __('Regenerate Recovery Codes'),
            __('Please confirm your password to regenerate your recovery codes.')
        );
    }

    public function requestDisableTwoFactor()
    {
        $this->openConfirmModal(
            'disable',
            __('Disable Two Factor Authentication'),
            __('Please confirm your password to disable two factor authentication.')
        );
    }

    public function requestShowQrCode()
    {
        $this->openConfirmModal(
            'show_qr',
            __('Show QR Code'),
            __('Please confirm your password to view the QR code for enabling two factor authentication.')
        );
    }

    public function confirmModalAction()
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        switch ($this->modalAction) {
            case 'enable':
                $this->enableTwoFactor(true);
                break;
            case 'show_recovery':
                $this->showingRecoveryCodes = true;
                break;
            case 'regenerate_recovery':
                $this->regenerateRecoveryCodes(true);
                break;
            case 'disable':
                $this->disableTwoFactor(true);
                break;
            case 'show_qr':
                $this->showingQrCode = true;
                break;
        }

        $this->showConfirmModal = false;
        $this->password = '';
    }

    public function enableTwoFactor($fromModal = false)
    {
        if (!$fromModal) {
            $this->requestEnableTwoFactor();
            return;
        }
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

        $this->showingRecoveryCodes = true;

        $this->success('Two Factor Authentication Enabled', position:'bottom-right');
    }

    public function regenerateRecoveryCodes($fromModal = false)
    {
        if (!$fromModal) {
            $this->requestRegenerateRecoveryCodes();
            return;
        }
        $user = Auth::user();
        $this->recoveryCodes = (new Recovery())->toJson();
        $user->two_factor_recovery_codes = $this->recoveryCodes;
        $user->save();

        $this->showingRecoveryCodes = true;
        $this->success('Recovery codes have been regenerated', position:'bottom-right');
    }

    public function disableTwoFactor($fromModal = false): void
    {
        if (!$fromModal) {
            $this->requestDisableTwoFactor();
            return;
        }
        $user = Auth::user();
        $user->two_factor_secret = null;
        $user->two_factor_recovery_codes = null;
        $user->two_factor_confirmed_at = null;
        $user->save();

        $this->disableTwoFactorModel = false;

        $this->success('Dashboard refreshed successfully!', position:'bottom-right');
    }
}; ?>

<section class="w-full">
    @include('users::partials.settings-heading')

    <x-users::settings.layout :heading="__('Two Factor Authentication')" :subheading="__('Add additional security to your account using two factor authentication.')">
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
                        <x-mary-button label="{{ __('Confirm') }}" wire:click="requestEnableTwoFactor" class="btn-primary" spinner />
                        <x-mary-button label="{{ __('Cancel') }}" wire:click="toggleQrCode" class="btn" />
                    </div>
                </div>
            @else
                <div class="mt-2 space-y-4">
                    <span class="text-md font-semibold">You have not enabled two factor authentication.</span>

                    <p class="text-sm">When two factor authentication is enabled, you will be prompted for a secure, random
                        token during authentication. You may retrieve this token from your phone's Google Authenticator
                        application.</p>

                    <x-mary-button label="{{ __('Enable') }}" wire:click="requestShowQrCode" class="btn-primary" spinner />
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
                        <x-mary-button label="{{ __('Show Recovery Codes') }}" wire:click="requestShowRecoveryCodes"
                            class="btn" spinner />
                    @else
                        <x-mary-button label="{{ __('Regenerate Recovery Codes') }}" wire:click="requestRegenerateRecoveryCodes" class="btn" spinner />
                    @endif
                    <x-mary-button label="{{ __('Disable') }}" wire:click="requestDisableTwoFactor" class="btn-primary" spinner />
                </div>
            </div>
        @endif

        <x-mary-modal wire:model="disableTwoFactorModel" title="{{ __('Disable two factor') }}" subtitle="{{ __('Are you sure you want to disable your two factor authentication? Once your is disabled, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to disable your two factor authentication.') }}">

            <x-mary-form wire:submit="disableTwoFactor" no-separator>
                <!-- Password -->
                <x-mary-password :label="__('Password')" wire:model="password" :placeholder="__('Password')" password-icon="o-lock-closed"
                password-visible-icon="o-lock-open" inline right required autocomplete="current-password" />

                <x-slot:actions>
                    <x-mary-button label="{{ __('Cancel') }}" @click="$wire.disableTwoFactorModel = false" />
                    <x-mary-button label="{{ __('Disable two factor') }}" wire:click='disableTwoFactor' class="btn-primary" type="submit" spinner />
                </x-slot:actions>
            </x-mary-form>
        </x-mary-modal>

        <x-mary-modal wire:model="showConfirmModal" :title="$modalHeader" :subtitle="$modalSubheader">
            <x-mary-form wire:submit="confirmModalAction" no-separator>
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
