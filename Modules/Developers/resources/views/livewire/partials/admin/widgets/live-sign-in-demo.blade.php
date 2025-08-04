<?php

use Livewire\Volt\Component;

new class extends Component {
    public function mount()
    {
        //
    }
}; ?>

<div class="border border-dashed bg-base-100 border-base-content/10 border-b-[length:var(--border)] mockup-browser">
    <div class="mockup-browser-toolbar">
        <div class="input">https://arabhardware.net</div>
    </div>
    <div class="place-content-center p-10 w-full border-t border-base-300">
        <div class="flex w-full gap-1 flex-col mb-10 text-center">
            <div>
                <x-mary-badge value="Live Demo" class="badge-primary" />
            </div>

            <div
                class="font-medium text-2xl [&:has(+[data-flux-subheading])]:mb-2 [[data-flux-subheading]+&]:mt-2">
                Arabhardware Social Login Integration
            </div>
            <div class="text-sm">Experience seamless authentication with ArabHardware OAuth</div>
        </div>
        <div class="flex place-content-center w-full ">
            <div class="card bg-base-100 rounded-box grid grow place-items-center">
                <livewire:partials.admin.widgets.login-form :formId="'browser'" />
            </div>
            <div class="divider divider-horizontal">OR</div>

            <div class="card {{-- p-10 --}} grid  grow place-items-center">
                <div class="col-span-2 mockup-phone ">
                    <div class="mockup-phone-camera"></div>
                    <div class="mockup-phone-display bg-base-100 grid place-content-center">
                        <livewire:partials.admin.widgets.login-form :formId="'phone'" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
