<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;

new #[Layout('developers::components.layouts.admin', ['pageTitle' => 'Arabhardware | OAuth2'])] class extends Component {
    use Toast;

    public $user;
    public $clients;
    public $selectedApp;
    public $selectedAppId;
    public $pageTitle = 'Arabhardware | OAuth2';

    // OAuth2 URL Generator
    public $selectedRedirectUri = '';
    public $selectedScopes = [];
    public $generatedUrl = '';

    // New redirect URI form
    public $newRedirectUri = '';
    public $showAddRedirectForm = false;

    // Available scopes
    public $availableScopes = [
        'profile' => [
            'name' => 'profile',
            'description' => 'Access to basic profile information (username, avatar, etc.)'
        ],
        'email' => [
            'name' => 'email',
            'description' => 'Access to user email address'
        ],
        'posts.read' => [
            'name' => 'posts.read',
            'description' => 'Read user posts and content'
        ],
        'posts.write' => [
            'name' => 'posts.write',
            'description' => 'Create and edit posts on behalf of the user'
        ],
        'forums.read' => [
            'name' => 'forums.read',
            'description' => 'Access to forum discussions and topics'
        ],
        'forums.write' => [
            'name' => 'forums.write',
            'description' => 'Participate in forums on behalf of the user'
        ],
        'marketplace.read' => [
            'name' => 'marketplace.read',
            'description' => 'Access to marketplace listings'
        ],
        'notifications.read' => [
            'name' => 'notifications.read',
            'description' => 'Read user notifications'
        ]
    ];

    public function mount($appId = null)
    {
        $this->user = Auth::user();
        $this->loadClients($this->user);

        if ($appId) {
            $this->selectedAppId = $appId;
            $this->loadSelectedApp();
        }
    }

    public function loadClients($user)
    {
        $this->clients = $user->oauthApps()->get();
    }

    public function updatedSelectedAppId($value)
    {
        if ($value) {
            $this->loadSelectedApp();
        } else {
            $this->resetAppData();
        }
    }

    public function loadSelectedApp()
    {
        $app = $this->user->oauthApps()->find($this->selectedAppId);
        if ($app) {
            $this->selectedApp = $app;
            $this->selectedRedirectUri = $app->redirect_uris ? collect($app->redirect_uris)->first() : '';
            $this->generateOAuthUrl();
        }
    }

    public function resetAppData()
    {
        $this->selectedApp = null;
        $this->selectedRedirectUri = '';
        $this->selectedScopes = [];
        $this->generatedUrl = '';
    }

    public function updatedSelectedRedirectUri()
    {
        $this->generateOAuthUrl();
    }

    public function updatedSelectedScopes()
    {
        $this->generateOAuthUrl();
    }

    public function generateOAuthUrl()
    {
        if (!$this->selectedApp || !$this->selectedRedirectUri) {
            $this->generatedUrl = '';
            return;
        }

        $baseUrl = config('app.url') == 'http://localhost' ? 'http://localhost:8000' : config('app.url');
        $scopes = implode(' ', $this->selectedScopes);

        $params = [
            'client_id' => $this->selectedApp->id,
            'response_type' => 'code',
            'redirect_uri' => $this->selectedRedirectUri,
            'scope' => $scopes
        ];

        $this->generatedUrl = $baseUrl . '/oauth/authorize?' . http_build_query($params);
    }

    public function addRedirectUri()
    {
        if (!$this->selectedApp || !$this->newRedirectUri) {
            $this->error('Please enter a valid redirect URI.');
            return;
        }

        // Validate URL
        if (!filter_var($this->newRedirectUri, FILTER_VALIDATE_URL)) {
            $this->error('Please enter a valid URL.');
            return;
        }

        try {
            $redirectUris = $this->selectedApp->redirect_uris ?? [];

            if (in_array($this->newRedirectUri, $redirectUris)) {
                $this->error('This redirect URI already exists.');
                return;
            }

            $redirectUris[] = $this->newRedirectUri;

            $this->selectedApp->update([
                'redirect_uris' => $redirectUris
            ]);

            $this->success('Redirect URI added successfully!');
            $this->newRedirectUri = '';
            $this->showAddRedirectForm = false;
            $this->loadSelectedApp(); // Refresh data
        } catch (\Exception $e) {
            $this->error('Failed to add redirect URI. Please try again.');
        }
    }

    public function removeRedirectUri($uri)
    {
        if (!$this->selectedApp) return;

        try {
            $redirectUris = $this->selectedApp->redirect_uris ?? [];
            $redirectUris = array_filter($redirectUris, fn($item) => $item !== $uri);

            $this->selectedApp->update([
                'redirect_uris' => array_values($redirectUris)
            ]);

            $this->success('Redirect URI removed successfully!');
            $this->loadSelectedApp(); // Refresh data
        } catch (\Exception $e) {
            $this->error('Failed to remove redirect URI. Please try again.');
        }
    }

    public function regenerateClientSecret()
    {
        if (!$this->selectedApp) return;

        try {
            $newSecret = Str::random(40);
            $this->selectedApp->update([
                'secret' => Hash::make($newSecret)
            ]);

            $this->success('Client secret regenerated successfully! Make sure to update your application with the new secret.');
            // In a real implementation, you'd show the new secret to the user once
        } catch (\Exception $e) {
            $this->error('Failed to regenerate client secret. Please try again.');
        }
    }

    public function copyToClipboard()
    {
        $this->dispatch('copy-to-clipboard', url: $this->generatedUrl);
    }
}; ?>

<div class="max-w-7xl mx-auto min-h-screen">
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">

            <!-- Header -->
            <x-mary-card class="border border-dashed bg-base-100 border-base-content/10 border-b-[length:var(--border)]">
                <x-slot:title>
                    <h2 class="text-2xl flex gap-1 mb-4">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        OAuth2
                    </h2>
                </x-slot:title>
                <p class="text-sm mb-5">
                    Use Arabhardware as an authorization system or use our API on behalf of your users.
                    Add a redirect URI, pick your scopes, and integrate seamlessly with your application!
                </p>

                <x-mary-alert title="Learn More"
                    description="OAuth2 is a secure authorization framework that allows your application to access Arabhardware resources on behalf of users without exposing their credentials."
                    icon="o-information-circle"
                    class="alert-info" />
            </x-mary-card>

            <!-- App Selection -->
            @if($clients->count() > 0)
            <x-mary-card class="border border-dashed bg-base-100 border-base-content/10">
                <x-slot:title>
                    <h3 class="text-xl mb-4">Select Application</h3>
                </x-slot:title>

                <x-mary-select
                    label="Choose Application"
                    wire:model.live="selectedAppId"
                    :options="$clients"
                    option-value="id"
                    option-label="name"
                    placeholder="Select an application to configure OAuth2"
                    class="mb-4" />
            </x-mary-card>
            @endif

            @if($selectedApp)
            <!-- Client Information -->
            <x-mary-card class="border border-dashed bg-base-100 border-base-content/10">
                <x-slot:title>
                    <h3 class="text-xl mb-4">Client Information</h3>
                </x-slot:title>

                <div class="space-y-6">
                    <!-- Client ID -->
                    <div>
                        <label class="label">
                            <span class="label-text font-medium">Client ID</span>
                        </label>
                        <div class="flex items-center gap-2">
                            <input type="text"
                                   class="input input-bordered flex-1"
                                   value="{{ $selectedApp->id }}"
                                   readonly>
                            <button class="btn btn-square btn-outline"
                                    onclick="navigator.clipboard.writeText('{{ $selectedApp->id }}')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Client Secret -->
                    <div>
                        <label class="label">
                            <span class="label-text font-medium">Client Secret</span>
                        </label>
                        <div class="flex items-center gap-2">
                            <input type="password"
                                   class="input input-bordered flex-1"
                                   value="••••••••••••••••••••••••••••••••••••••••"
                                   readonly>
                            <x-mary-button
                                label="Regenerate"
                                wire:click="regenerateClientSecret"
                                class="btn-outline btn-warning"
                                wire:confirm="Are you sure? This will invalidate the current secret." />
                        </div>
                        <div class="label">
                            <span class="label-text-alt text-warning">Hidden for security. Store securely and never expose in client-side code.</span>
                        </div>
                    </div>

                    <!-- Public Client -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Public Client</span>
                        </label>
                        <div class="flex items-center gap-3">
                            <input type="checkbox"
                                   class="checkbox checkbox-primary"
                                   {{ $selectedApp->is_public ? 'checked' : '' }}
                                   disabled>
                            <span class="text-sm text-base-content/70">
                                Public clients cannot maintain the confidentiality of their client credentials
                                (i.e. desktop/mobile applications that do not use a server to make requests)
                            </span>
                        </div>
                    </div>
                </div>
            </x-mary-card>

            <!-- Redirects -->
            <x-mary-card class="border border-dashed bg-base-100 border-base-content/10">
                <x-slot:title>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl">Redirects</h3>
                        <x-mary-button
                            label="Add Redirect"
                            wire:click="$set('showAddRedirectForm', true)"
                            class="btn-primary btn-sm"
                            icon="o-plus" />
                    </div>
                </x-slot:title>

                <p class="text-sm text-base-content/70 mb-4">
                    You must specify at least one URI for authentication to work. If you pass a URI in an OAuth request,
                    it must exactly match one of the URIs you enter here.
                </p>

                @if($showAddRedirectForm)
                <div class="bg-base-200 p-4 rounded-lg mb-4">
                    <div class="flex gap-2">
                        <x-mary-input
                            wire:model="newRedirectUri"
                            placeholder="https://yourapp.com/callback"
                            class="flex-1" />
                        <x-mary-button
                            label="Add"
                            wire:click="addRedirectUri"
                            class="btn-primary" />
                        <x-mary-button
                            label="Cancel"
                            wire:click="$set('showAddRedirectForm', false)"
                            class="btn-ghost" />
                    </div>
                </div>
                @endif

                @if($selectedApp->redirect_uris && count($selectedApp->redirect_uris) > 0)
                <div class="space-y-3">
                    @foreach($selectedApp->redirect_uris as $uri)
                    <div class="flex items-center justify-between p-3 bg-base-200 rounded-lg">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                            <code class="text-sm">{{ $uri }}</code>
                        </div>
                        <x-mary-button
                            icon="o-trash"
                            wire:click="removeRedirectUri('{{ $uri }}')"
                            class="btn-error btn-sm btn-outline"
                            wire:confirm="Are you sure you want to remove this redirect URI?" />
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8">
                    <svg class="w-12 h-12 mx-auto text-base-content/40 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                    <p class="text-base-content/60">No redirect URIs configured</p>
                    <p class="text-sm text-base-content/40">Add at least one redirect URI to enable OAuth2 authentication</p>
                </div>
                @endif
            </x-mary-card>

            <!-- OAuth2 URL Generator -->
            @if($selectedApp->redirect_uris && count($selectedApp->redirect_uris) > 0)
            <x-mary-card class="border border-dashed bg-base-100 border-base-content/10">
                <x-slot:title>
                    <h3 class="text-xl mb-4">OAuth2 URL Generator</h3>
                </x-slot:title>

                <p class="text-sm text-base-content/70 mb-6">
                    Generate an authorization link for your application by picking the scopes and permissions it needs to function.
                    Then, share the URL to others!
                </p>

                <div class="space-y-6">
                    <!-- Scopes Selection -->
                    <div>
                        <label class="label">
                            <span class="label-text font-medium">Scopes</span>
                        </label>
                        <div class="grid md:grid-cols-2 gap-3">
                            @foreach($availableScopes as $scope)
                            <div class="form-control">
                                <label class="label cursor-pointer justify-start gap-3">
                                    <input type="checkbox"
                                           class="checkbox checkbox-primary checkbox-sm"
                                           wire:model.live="selectedScopes"
                                           value="{{ $scope['name'] }}">
                                    <div>
                                        <div class="font-medium text-sm">{{ $scope['name'] }}</div>
                                        <div class="text-xs text-base-content/60">{{ $scope['description'] }}</div>
                                    </div>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Redirect URL Selection -->
                    <div>
                        <x-mary-select
                            label="Select redirect URL"
                            wire:model.live="selectedRedirectUri"
                            :options="collect($selectedApp->redirect_uris)->map(fn($uri) => ['id' => $uri, 'name' => $uri])"
                            option-value="id"
                            option-label="name"
                            placeholder="Choose a redirect URI" />
                    </div>

                    <!-- Generated URL -->
                    @if($generatedUrl)
                    <div>
                        <label class="label">
                            <span class="label-text font-medium">Generated URL</span>
                        </label>
                        <div class="flex gap-2">
                            <textarea class="textarea textarea-bordered flex-1 h-24 font-mono text-sm"
                                      readonly>{{ $generatedUrl }}</textarea>
                            <div class="flex flex-col gap-2">
                                <x-mary-button
                                    icon="o-clipboard"
                                    class="btn-outline"
                                    onclick="navigator.clipboard.writeText('{{ $generatedUrl }}')" />
                                <x-mary-button
                                    icon="o-arrow-top-right-on-square"
                                    class="btn-outline"
                                    onclick="window.open('{{ $generatedUrl }}', '_blank')" />
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </x-mary-card>
            @endif

            @else
            <!-- No App Selected -->
            <x-mary-card class="border border-dashed bg-base-100 border-base-content/10">
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-base-content/40 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    <h3 class="text-xl font-medium mb-2">No Application Selected</h3>
                    <p class="text-base-content/60">
                        @if($clients->count() === 0)
                            You don't have any applications yet. Create an application first to configure OAuth2.
                        @else
                            Select an application above to configure OAuth2 settings and generate authorization URLs.
                        @endif
                    </p>
                </div>
            </x-mary-card>
            @endif

        </div>

        <!-- Sidebar -->
        <livewire:partials.admin.right-sidebar />
    </div>
</div>

@script
<script>
    // Copy to clipboard functionality
    $wire.on('copy-to-clipboard', (event) => {
        navigator.clipboard.writeText(event.url).then(() => {
            // You can add a toast notification here
            console.log('URL copied to clipboard');
        });
    });

    // Auto-copy functionality for inputs
    document.addEventListener('click', function(e) {
        if (e.target.closest('.copy-input')) {
            const input = e.target.closest('.copy-input').previousElementSibling;
            input.select();
            navigator.clipboard.writeText(input.value);

            // Visual feedback
            const btn = e.target.closest('.copy-input');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
            btn.classList.add('btn-success');

            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.classList.remove('btn-success');
            }, 2000);
        }
    });
</script>
@endscript
