<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;

new #[Layout('developers::components.layouts.master', ['navbarClass' => 'bg-base-100'])] class extends Component {
    use Toast;

    public $pageTitle = 'Arabhardware | Developers';
    public $clients = [];
    public bool $showModal = false;
    public $name = '';
    public $redirect = '';

    public function mount()
    {
        $this->loadClients();
    }

    public function loadClients()
    {
        $user = Auth::user();
        $this->clients = $user->oauthApps()->get();
        //dd($this->clients);
    }

    public function createClient()
    {
        $user = Auth::user();

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'redirect' => ['required', 'url'],
        ]);

        //dd([$this->name,$this->redirect]);

        // Creating an OAuth app client that belongs to the given user...
        $client = app(ClientRepository::class)->createAuthorizationCodeGrantClient(user: $user, name: $this->name, redirectUris: [$this->redirect], confidential: false, enableDeviceFlow: true);

        // Retrieving all the OAuth app clients that belong to the user...
        $this->clients = $user->oauthApps()->get();

        $this->reset('name', 'redirect');
        $this->success('App created successfully!', position: 'bottom-right');
        $this->showModal = false;
        $this->dispatch('app-created');

        //$this->redirectIntended(default: route('settings.profile', absolute: false), navigate: true);
    }
}; ?>
<div>
    <section class="px-2 pt-32 pb-32 bg-white md:px-0">
        <div class="container items-center max-w-6xl px-5 mx-auto space-y-6 text-center">
            <h1
                class="text-4xl font-extrabold tracking-tight text-left text-gray-900 sm:text-5xl md:text-6xl md:text-center">
                <span class="block">Level Up Your <span class="block mt-1 text-primary lg:inline lg:mt-0"
                        data-primary="primary">API Integrations</span></span>
            </h1>
            <p
                class="w-full mx-auto text-base text-left text-gray-500 md:max-w-md sm:text-lg lg:text-2xl md:max-w-3xl md:text-center">
                Manage your API clients and create new integrations easily.
            </p>
            <div class="relative flex flex-col justify-center md:flex-row md:space-x-4">
                <a href="{{ route('developers.dashboard') }}"
                    class="flex cursor-pointer items-center w-full px-6 py-3 mb-3 text-lg text-white bg-primary rounded-md md:mb-0 hover:bg-primary-700 md:w-auto"
                    data-primary="purple-500" data-rounded="rounded-md" wire:navigate>
                    Go to Dashboard
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
                <a href="/api/docs" target="_blank"
                    class="flex cursor-pointer items-center px-6 py-3 text-gray-500 bg-gray-100 rounded-md hover:bg-gray-200 hover:text-gray-600"
                    data-rounded="rounded-md">
                    API Documentation
                </a>
            </div>
            <div class="relative flex flex-col justify-center md:flex-row md:space-x-4 items-center min-h-[60vh] pt-24">
                <div class="{{ $clients->count() > 3 ? 'grid grid-cols-5 gap-5':'flex gap-6' }}">
                    <!-- New App Card -->
                    <div class="flex flex-col items-center justify-center w-48 h-48 border-2 border-dashed border-gray-400 rounded-lg cursor-pointer hover:bg-gray-50"
                        @click="$wire.showModal = true">
                        <span class="text-gray-400 text-4xl">+</span>
                        <span class="mt-2 text-gray-500 font-semibold">New App</span>
                    </div>

                    <!-- Existing Clients -->
                    @foreach ($clients as $client)
                        <a href="{{ route('developers.dashboard') }}" class="flex flex-col items-center justify-center w-48 h-48 bg-white border rounded-lg shadow hover:bg-gray-50 transition cursor-pointer">
                            <img src="{{asset('app.webp')}}" width="80">
                            <span class="font-bold text-lg">{{ $client->name }}</span>
                            {{-- <span class="text-xs text-gray-500 mt-2 break-all">{{ $client->id }}</span> --}}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

    </section>

    <x-mary-modal wire:model="showModal" :title="__('Create New App')" :subtitle="__('Fill in the details to create a new OAuth app for API access.')">
        <x-mary-form wire:submit="createClient" no-separator>
            <!-- Name -->
            <x-mary-input :label="__('Name')" wire:model="name" placeholder="{{ __('App name') }}" inline clearable
                required autofocus autocomplete="name" />

            <!-- Url -->
            <x-mary-input :label="__('URL')" wire:model="redirect" icon="o-link" placeholder="{{ __('Redirect Url') }}"
                inline clearable required />

            <x-slot:actions>
                <x-mary-button label="{{ __('Cancel') }}" @click="$wire.showModal = false" />
                <x-mary-button label="{{ __('Save') }}" class="btn-primary" type="submit" spinner />
            </x-slot:actions>
        </x-mary-form>
    </x-mary-modal>
</div>
