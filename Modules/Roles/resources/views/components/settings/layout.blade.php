<div class="flex items-start max-md:flex-col">
    <div class="me-10 w-full pb-4 md:w-[220px]">
        <x-mary-menu activate-by-route active-bg-color="font-black" class="p-0">
            <x-mary-menu-item link="{{ route('settings.profile') }}" title="{{ __('Profile') }}" wire:navigate />
            <x-mary-menu-item link="{{ route('settings.password') }}" title="{{ __('Password') }}" wire:navigate />
            <x-mary-menu-item link="{{ route('settings.appearance') }}" title="{{ __('Appearance') }}" wire:navigate />
            <x-mary-menu-item link="{{ route('settings.two-factor') }}" title="{{ __('Two Factor Authentication') }}" wire:navigate />
            <x-mary-menu-item link="{{ route('settings.sessions') }}" title="{{ __('Browser Sessions') }}" wire:navigate />
        </x-mary-menu>
    </div>

    <div class="flex-1 self-stretch max-md:pt-6">
        <x-mary-header title="{{ $heading ?? '' }}" subtitle="{{ $subheading ?? '' }}" size="text-sm" />

        <div class="mt-5 w-full max-w-lg">
            {{ $slot }}
        </div>
    </div>
</div>
