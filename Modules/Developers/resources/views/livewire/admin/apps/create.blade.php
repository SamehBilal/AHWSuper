<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

new #[Layout('developers::components.layouts.admin')] class extends Component {
    use Toast, WithFileUploads;
    public $user;
    public $image;
    public $pageTitle = 'Arabhardware | Developers';

    // Form fields
    public $clientId = null; // For edit mode
    public $name = '';
    public $description = '';
    public $redirect_uris = []; // Multiple redirect URLs
    public $callback_urls = []; // Multiple redirect URLs
    public $grant_types = []; // Multiple redirect URLs
    public $website_url = '';
    public $privacy_policy_url = '';
    public array $tags = [];
    public $client_secret = '';
    public $generated_client_id = '';
    public $selectedRedirectUrl = ''; // For OAuth URL generator
    public $revoked; // For OAuth URL generator
    public $owner_id; // For OAuth URL generator
    public $users; // For OAuth URL generator

    // Mode tracking
    public $isEdit = false;
    public $client = null;

    // Available tags for suggestions
    public $availableTags = ['web-app', 'mobile-app', 'desktop-app', 'api-integration', 'gaming', 'productivity', 'social', 'e-commerce', 'education', 'healthcare'];
    // OAuth2 URL Generator
    public $selectedScopes = [];
    public $customState = '';
    public $generatedAuthUrl = '';

     public $availableGrantTypes = [
        'password' => 'Read user profile information',
        'authorization_code' => 'Read user email address',
        'refresh_token' => 'Update user profile information',
    ];

    // Available OAuth scopes
    public $availableScopes = [
        'read:user' => 'Read user profile information',
        'read:email' => 'Read user email address',
        'write:user' => 'Update user profile information',
        'read:posts' => 'Read user posts and content',
        'write:posts' => 'Create and update posts',
        'delete:posts' => 'Delete posts',
    ];

    public function mount($app = null)
    {
        $this->user = Auth::user();

        $this->users = \App\Models\User::select('id', 'name', 'email')
            ->orderBy('name')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name . ' (' . $user->email . ')'
                ];
            })
            ->toArray();

        if ($app) {
            $this->clientId = $app;
            $this->isEdit = true;
            $this->loadClient($app);
        } else {
            // Initialize with one empty redirect URL for new apps
            $this->redirect_uris = [''];
            $this->grant_types = ['authorization_code', 'refresh_token']; // Default grant types
            $this->owner_id = $this->user->id; // Default to current user
        }
    }

    public function loadClient($clientId)
    {
        try {
            $this->client = $this->user->oauthApps()->findOrFail($clientId);

            // Populate form fields
            $this->name = $this->client->name;
            $this->client_secret = $this->client->secret;
            $this->generated_client_id = $this->client->id;
            $this->revoked = (bool) $this->client->revoked;
            $this->owner_id = $this->client->owner_id ?? $this->client->user_id ?? null;

            //dd($this->client->grant_types);

            // Parse JSON fields
            $this->redirect_uris = $this->client->redirect_uris;
            if (empty($this->redirect_uris)) {
                $this->redirect_uris = [''];
            }

            $this->grant_types = $this->client->grant_types;
            if (empty($this->grant_types)) {
                $this->grant_types = ['authorization_code', 'refresh_token'];
            }

            // Load additional fields if they exist (assuming you have a meta table or json field)
            $meta = json_decode($this->client->meta ?? '{}', true);
            $this->description = $meta['description'] ?? '';
            $this->website_url = $meta['website_url'] ?? '';
            $this->privacy_policy_url = $meta['privacy_policy_url'] ?? '';
            $this->tags = $meta['tags'] ?? [];

            $this->selectedRedirectUrl = $this->redirect_uris[0] ?? '';

            // Generate initial OAuth URL
            $this->generateOAuthUrl();

        } catch (Exception $e) {
            $this->error('OAuth client not found!', position: 'bottom-right');
            return redirect()->route('developers.apps.index');
        }
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'redirect_uris' => ['required', 'array', 'min:1', 'max:10'],
            'redirect_uris.*' => ['required', 'url', 'max:255'],
            'callback_urls' => ['required', 'array', 'min:1', 'max:10'],
            'callback_urls.*' => ['required', 'url', 'max:255'],
            'grant_types' => ['required', 'array', 'min:1'],
            'grant_types.*' => ['string', 'in:' . implode(',', array_keys($this->availableGrantTypes))],
            'owner_id' => ['required', 'exists:users,id'],
            'revoked' => ['boolean'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'privacy_policy_url' => ['nullable', 'url', 'max:255'],
            'tags' => ['array', 'max:10'],
            'tags.*' => ['string', 'max:50'],
            'image' => ['nullable', 'image', 'max:2048'], // 2MB max
        ];
    }

    public function save()
    {
        $this->validate();

        try {
            if ($this->isEdit) {
                $this->updateClient();
            } else {
                $this->createClient();
            }
        } catch (Exception $e) {
            $this->error('Error saving OAuth client: ' . $e->getMessage(), position: 'bottom-right');
        }
    }

    private function createClient()
    {
        // Filter out empty URLs
        $validUrls = array_filter($this->redirect_uris, function($url) {
            return !empty(trim($url));
        });

        // Create the OAuth client
        $client = Client::create([
            'id' => (string) Str::uuid(),
            'name' => $this->name,
            'secret' => Str::random(40),
            'redirect_uris' => json_encode(array_values($validUrls)),
            'grant_types' => json_encode($this->grant_types),
            'owner_type' => 'App\\Models\\User',
            'owner_id' => $this->owner_id,
            'revoked' => $this->revoked,
        ]);

        // Store additional metadata
        $meta = [
            'description' => $this->description,
            'website_url' => $this->website_url,
            'privacy_policy_url' => $this->privacy_policy_url,
            'tags' => $this->tags,
        ];

        // If you have a meta column, update it
        $client->update(['meta' => json_encode($meta)]);

        // Handle image upload
        if ($this->image) {
            $this->handleImageUpload($client);
        }

        $this->success('OAuth client created successfully!', position: 'bottom-right');
        return redirect()->route('developers.apps.index');
    }

    private function updateClient()
    {
        // Filter out empty URLs
        $validUrls = array_filter($this->redirect_uris, function($url) {
            return !empty(trim($url));
        });

        // Update the OAuth client
        $this->client->update([
            'name' => $this->name,
            'redirect_uris' => json_encode(array_values($validUrls)),
            'grant_types' => json_encode($this->grant_types),
            'owner_id' => $this->owner_id,
            'revoked' => $this->revoked,
        ]);

        // Update additional metadata
        $meta = [
            'description' => $this->description,
            'website_url' => $this->website_url,
            'privacy_policy_url' => $this->privacy_policy_url,
            'tags' => $this->tags,
        ];

        $this->client->update(['meta' => json_encode($meta)]);

        // Handle image upload
        if ($this->image) {
            $this->handleImageUpload($this->client);
        }

        $this->success('OAuth client updated successfully!', position: 'bottom-right');
    }

    private function handleImageUpload($client)
    {
        // Store the image and update client with image path
        $path = $this->image->store('oauth-clients', 'public');

        // Update meta with image path or create a separate images table
        $meta = json_decode($client->meta ?? '{}', true);
        $meta['image'] = $path;
        $client->update(['meta' => json_encode($meta)]);
    }

    public function regenerateSecret()
    {
        if (!$this->isEdit) {
            $this->warning('Cannot regenerate secret for new app. Create the app first.', position: 'bottom-right');
            return;
        }

        try {
            $newSecret = Str::random(40);
            $this->client->update(['secret' => $newSecret]);
            $this->client_secret = $newSecret;

            $this->success('Client secret regenerated successfully!', position: 'bottom-right');
        } catch (Exception $e) {
            $this->error('Error regenerating secret: ' . $e->getMessage(), position: 'bottom-right');
        }
    }

    public function copyToClipboard($text, $type)
    {
        // This will be handled by JavaScript
        $this->dispatch('copy-to-clipboard', text: $text, type: $type);
    }

    public function generateOAuthUrl()
    {
        if (!$this->isEdit || !$this->client || empty($this->selectedRedirectUrl)) {
            $this->generatedAuthUrl = '';
            return;
        }

        $baseUrl = config('app.url'); // Your app's base URL
        $params = [
            'client_id' => $this->generated_client_id,
            'redirect_uri' => $this->selectedRedirectUrl,
            'response_type' => 'code',
            'scope' => implode(' ', $this->selectedScopes),
        ];

        if (!empty($this->customState)) {
            $params['state'] = $this->customState;
        }

        $this->generatedAuthUrl = $baseUrl . '/oauth/authorize?' . http_build_query($params);
    }

    public function updatedSelectedScopes()
    {
        $this->generateOAuthUrl();
    }

    public function updatedCustomState()
    {
        $this->generateOAuthUrl();
    }

    public function updatedSelectedRedirectUrl()
    {
        $this->generateOAuthUrl();
    }

    public function addRedirectUrl()
    {
        if (count($this->redirect_uris) < 10) {
            $this->redirect_uris[] = '';
        } else {
            $this->warning('Maximum 10 redirect URLs allowed', position: 'bottom-right');
        }
    }

    public function removeRedirectUrl($index)
    {
        if (count($this->redirect_uris) > 1) {
            unset($this->redirect_uris[$index]);
            $this->redirect_uris = array_values($this->redirect_uris); // Re-index array

            // Update selected redirect URL if it was removed
            if ($this->selectedRedirectUrl === ($this->redirect_uris[$index] ?? '')) {
                $this->selectedRedirectUrl = $this->redirect_uris[0] ?? '';
                $this->generateOAuthUrl();
            }
        } else {
            $this->warning('At least one redirect URL is required', position: 'bottom-right');
        }
    }

    public function selectAllScopes()
    {
        $this->selectedScopes = array_keys($this->availableScopes);
        $this->generateOAuthUrl();
    }

    public function clearAllScopes()
    {
        $this->selectedScopes = [];
        $this->generateOAuthUrl();
    }

    public function goBack()
    {
        return redirect()->route('developers.apps.index');
    }
}; ?>

<div class="max-w-7xl mx-auto min-h-screen ">
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">

            <x-mary-header
                icon="o-code-bracket"
                icon-classes="bg-primary text-white rounded-full p-1 w-6 h-6"
                :title="$isEdit ? 'Edit App' : 'Create App'"
                :subtitle="$isEdit ? 'Update your OAuth application settings' : 'Create a new app to use our tools and API'"
                separator
                progress-indicator="save"
                progress-indicator-class="progress-primary">
                <x-slot:middle class="!justify-end">
                    <!-- Empty for now -->
                </x-slot:middle>
                <x-slot:actions>
                    <x-mary-button
                        wire:click="goBack"
                        icon="o-arrow-left"
                        class="btn-sm btn-ghost"
                        title="Back to Apps"
                    />
                    @if($isEdit)
                        <x-mary-button
                            wire:click="regenerateSecret"
                            icon="o-arrow-path"
                            class="btn-sm btn-warning"
                            title="Regenerate Secret"
                        />
                    @endif
                    <x-mary-button
                        wire:click="save"
                        icon="o-check"
                        class="btn-primary btn-sm"
                        :loading="$loading ?? false"
                        title="{{ $isEdit ? 'Update App' : 'Create App' }}"
                    />
                </x-slot:actions>
            </x-mary-header>

            <!-- App Image and Basic Info -->
            <div class="grid lg:grid-cols-4 gap-6">
                <!-- App Image -->
                <x-mary-card class="lg:col-span-1">
                    <x-mary-file wire:model="image" accept="image/png,image/jpg,image/jpeg" crop-after-change>
                        <x-slot:label>
                            <div class="text-md mb-1">App Icon</div>
                        </x-slot:label>
                        <img src="{{ $user->avatar ?? asset('camera.webp') }}"
                            class="w-40 p-4 rounded-lg border border-dashed bg-base-100 border-base-content/10" />
                    </x-mary-file>
                </x-mary-card>

                <!-- Basic App Info -->
                <x-mary-card class="lg:col-span-3">
                    <!-- App Name -->
                    <x-mary-input
                        label="App Name"
                        wire:model="name"
                        placeholder="My awesome application"
                        clearable
                        required
                        autofocus
                        class="mb-1"
                    />

                    <!-- App Description -->
                    <x-mary-textarea
                        label="Description"
                        wire:model="description"
                        placeholder="Describe what your app does..."
                        rows="4"
                        clearable
                        class="mb-1"
                    />

                    <!-- Tags -->
                    <x-mary-tags
                        label="Tags"
                        wire:model="tags"
                        icon="o-tag"
                        :options="collect($availableTags)->map(fn($tag) => ['id' => $tag, 'name' => $tag])->toArray()"
                        clearable
                        class="mb-1"
                    />
                </x-mary-card>
            </div>

            <!-- App URLs and Configuration -->
            <x-mary-card title="App Configuration" subtitle="Configure your application settings">
                <!-- Grant Types -->
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-3">Grant Types</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 p-4 bg-base-100 border border-base-content/10 rounded-lg">
                        @foreach($availableGrantTypes as $grantType => $description)
                            <label class="flex items-start gap-3 cursor-pointer hover:bg-base-200 p-2 rounded transition-colors">
                                <input
                                    type="checkbox"
                                    wire:model="grant_types"
                                    value="{{ $grantType }}"
                                    class="checkbox checkbox-primary checkbox-sm mt-0.5"
                                >
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-medium text-base-content">{{ $grantType }}</div>
                                    <div class="text-xs text-base-content/60 font-mono">{{ $description }}</div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <div class="text-xs text-base-content/60 mt-2">
                        💡 Select the OAuth2 grant types your application will use
                    </div>
                </div>

                <!-- Owner Selection -->
                <div class="mb-6">
                    <x-mary-select
                        label="App Owner"
                        wire:model="owner_id"
                        :options="$users"
                        placeholder="Select app owner..."
                        icon="o-user"
                        required
                        class="mb-2"
                    />
                    <div class="text-xs text-base-content/60">
                        The user who owns and manages this OAuth application
                    </div>
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">Application Status</label>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input
                                type="radio"
                                wire:model="revoked"
                                value="0"
                                class="radio radio-success radio-sm"
                            >
                            <span class="text-sm">Active</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input
                                type="radio"
                                wire:model="revoked"
                                value="1"
                                class="radio radio-error radio-sm"
                            >
                            <span class="text-sm">Revoked</span>
                        </label>
                    </div>
                </div>

                <!-- Multiple Redirect URLs -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-3">
                        <label class="block text-sm font-medium">Redirect URLs</label>
                        <x-mary-button
                            wire:click="addRedirectUrl"
                            icon="o-plus"
                            class="btn-xs btn-ghost text-primary"
                            title="Add another redirect URL"
                        >
                            Add URL
                        </x-mary-button>
                    </div>

                    <div class="space-y-3">
                        @foreach($redirect_uris as $index => $url)
                            <div class="flex gap-2 items-start">
                                <div class="flex-1">
                                    <x-mary-input
                                        wire:model="redirect_uris.{{ $index }}"
                                        icon="o-link"
                                        placeholder="https://yourapp.com/oauth/callback"
                                        clearable
                                        :class="$index === 0 ? 'border-primary' : ''"
                                    />
                                    @if($index === 0)
                                        <div class="text-xs text-primary mt-1 flex items-center gap-1">
                                            <x-mary-icon name="o-star" class="w-3 h-3" />
                                            Primary redirect URL
                                        </div>
                                    @endif
                                </div>

                                @if(count($redirect_uris) > 1)
                                    <x-mary-button
                                        wire:click="removeRedirectUrl({{ $index }})"
                                        icon="o-trash"
                                        class="btn-sm btn-ghost text-error"
                                        title="Remove this URL"
                                    />
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="text-xs text-base-content/60 mt-2">
                        💡 Add multiple redirect URLs for different environments (development, staging, production)
                    </div>
                </div>

                <!-- Website URL -->
                <x-mary-input
                    label="Website URL"
                    wire:model="website_url"
                    icon="o-globe-alt"
                    placeholder="https://yourapp.com"
                    clearable
                    class="mb-1"
                />

                <!-- Privacy Policy URL -->
                <x-mary-input
                    label="Privacy Policy URL"
                    wire:model="privacy_policy_url"
                    icon="o-shield-check"
                    placeholder="https://yourapp.com/privacy"
                    clearable
                    class="mb-1"
                />
            </x-mary-card>

            @if($isEdit && $client)
                <!-- Client Credentials -->
                <x-mary-card title="Client Credentials" subtitle="Your OAuth application credentials">
                    <!-- Client ID -->
                    <div class="mb-1">
                        <label class="block text-sm font-medium mb-2">Client ID</label>
                        <div class="flex gap-2">
                            <x-mary-input
                                value="{{ $generated_client_id }}"
                                readonly
                                class="flex-1"
                            />
                            <x-mary-button
                                icon="o-clipboard-document"
                                class="btn-sm btn-ghost"
                                title="Copy Client ID"
                                onclick="copyToClipboard('{{ $generated_client_id }}', 'Client ID')"
                            />
                        </div>
                    </div>

                    <!-- Client Secret -->
                    <div class="mb-1">
                        <label class="block text-sm font-medium mb-2">Client Secret</label>
                        <div class="flex gap-2">
                            <x-mary-input
                                value="{{ $client_secret }}"
                                type="password"
                                readonly
                                class="flex-1"
                            />
                            <x-mary-button
                                icon="o-clipboard-document"
                                class="btn-sm btn-ghost"
                                title="Copy Client Secret"
                                onclick="copyToClipboard('{{ $client_secret }}', 'Client Secret')"
                            />
                            <x-mary-button
                                icon="o-arrow-path"
                                class="btn-sm btn-warning"
                                title="Regenerate Secret"
                                wire:click="regenerateSecret"
                                onclick="return confirm('Are you sure? This will invalidate the current secret.')"
                            />
                        </div>
                        <div class="text-xs text-warning mt-1">
                            ⚠️ Keep your client secret secure and never expose it in client-side code
                        </div>
                    </div>
                </x-mary-card>
            @endif

            @if($isEdit && $client)
                <!-- OAuth2 URL Generator -->
                <x-mary-card title="OAuth2 URL Generator" subtitle="Generate authorization URLs for testing your OAuth integration">
                    <!-- Scopes Selection -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-3">
                            <label class="block text-sm font-medium">Select Scopes</label>
                            <div class="flex gap-2">
                                <x-mary-button
                                    wire:click="selectAllScopes"
                                    class="btn-xs btn-ghost text-primary"
                                >
                                    Select All
                                </x-mary-button>
                                <x-mary-button
                                    wire:click="clearAllScopes"
                                    class="btn-xs btn-ghost text-error"
                                >
                                    Clear All
                                </x-mary-button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 p-4 bg-base-100 border border-base-content/10 rounded-lg">
                            @foreach($availableScopes as $scope => $description)
                                <label class="flex items-start gap-3 cursor-pointer hover:bg-base-200 p-2 rounded transition-colors">
                                    <input
                                        type="checkbox"
                                        wire:model.live="selectedScopes"
                                        value="{{ $scope }}"
                                        class="checkbox checkbox-primary checkbox-sm mt-0.5"
                                    >
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-medium text-base-content">{{ $scope }}</div>
                                        <div class="text-xs text-base-content/60">{{ $description }}</div>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        @if(count($selectedScopes) > 0)
                            <div class="mt-2 text-xs text-base-content/60">
                                Selected scopes: <span class="font-mono bg-base-200 px-2 py-1 rounded">{{ implode(' ', $selectedScopes) }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Custom State Parameter -->
                    <div class="mb-1">
                        <x-mary-input
                            label="State Parameter (Optional)"
                            wire:model.live="customState"
                            placeholder="custom-state-value"
                            hint="A random string to prevent CSRF attacks"
                            class="font-mono text-sm"
                        />
                    </div>

                    <!-- Redirect URL Selection -->
                    @if(count($redirect_uris) > 1)
                        <div class="mb-1">
                            <label class="block text-sm font-medium mb-2">Select Redirect URL for Testing</label>
                            <select
                                wire:model.live="selectedRedirectUrl"
                                class="select select-bordered w-full font-mono text-sm"
                            >
                                <option value="">Choose a redirect URL...</option>
                                @foreach(array_filter($redirect_uris) as $index => $url)
                                    <option value="{{ $url }}">
                                        {{ $index === 0 ? '⭐ ' : '' }}{{ $url }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        @php
                            $this->selectedRedirectUrl = array_filter($redirect_uris)[0] ?? '';
                        @endphp
                    @endif

                    <!-- Generated URL -->
                    <div class="mb-1">
                        <label class="block text-sm font-medium mb-2">Generated Authorization URL</label>
                        @if($generatedAuthUrl)
                            <div class="flex gap-2">
                                <textarea
                                    readonly
                                    class="textarea textarea-bordered flex-1 font-mono text-xs resize-none"
                                    rows="3"
                                >{{ $generatedAuthUrl }}</textarea>
                                <div class="flex flex-col gap-2">
                                    <x-mary-button
                                        icon="o-clipboard-document"
                                        class="btn-sm btn-ghost"
                                        title="Copy Authorization URL"
                                        onclick="copyToClipboard('{{ $generatedAuthUrl }}', 'Authorization URL')"
                                    />
                                    <x-mary-button
                                        icon="o-arrow-top-right-on-square"
                                        class="btn-sm btn-primary"
                                        title="Test URL"
                                        onclick="window.open('{{ $generatedAuthUrl }}', '_blank')"
                                    />
                                </div>
                            </div>

                            <!-- URL Breakdown -->
                            <div class="mt-3 text-xs space-y-1">
                                <div class="text-base-content/60">URL Breakdown:</div>
                                <div><span class="font-semibold">Base URL:</span> <span class="font-mono">{{ config('app.url') }}/oauth/authorize</span></div>
                                <div><span class="font-semibold">Client ID:</span> <span class="font-mono">{{ $generated_client_id }}</span></div>
                                <div><span class="font-semibold">Redirect URI:</span> <span class="font-mono">{{ $selectedRedirectUrl }}</span></div>
                                <div><span class="font-semibold">Response Type:</span> <span class="font-mono">code</span></div>
                                @if(count($selectedScopes) > 0)
                                    <div><span class="font-semibold">Scopes:</span> <span class="font-mono">{{ implode(' ', $selectedScopes) }}</span></div>
                                @endif
                                @if($customState)
                                    <div><span class="font-semibold">State:</span> <span class="font-mono">{{ $customState }}</span></div>
                                @endif
                            </div>
                        @else
                            <div class="text-center py-8 text-base-content/40">
                                <x-mary-icon name="o-link" class="w-12 h-12 mx-auto mb-2" />
                                <div>Select at least one scope to generate the authorization URL</div>
                            </div>
                        @endif
                    </div>

                    <!-- Usage Instructions -->
                    <div class="bg-info/10 border border-info/20 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <x-mary-icon name="o-information-circle" class="w-5 h-5 text-info mt-0.5" />
                            <div class="text-sm">
                                <div class="font-semibold text-info mb-1">How to use this URL:</div>
                                <ol class="list-decimal list-inside space-y-1 text-base-content/70">
                                    <li>Add all your redirect URLs (dev, staging, production)</li>
                                    <li>Select the scopes your application needs</li>
                                    <li>Choose which redirect URL to test with</li>
                                    <li>Add a custom state parameter for security (recommended)</li>
                                    <li>Copy the generated URL or click "Test URL" to try it</li>
                                    <li>The user will be redirected to your chosen redirect URI with an authorization code</li>
                                    <li>Exchange the code for an access token using your client secret</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </x-mary-card>
            @endif

            <!-- Save Actions -->
            <div class="flex justify-end gap-4">
                <x-mary-button
                    wire:click="goBack"
                    class="btn-ghost"
                >
                    Cancel
                </x-mary-button>
                <x-mary-button
                    wire:click="save"
                    class="btn-primary"
                    :loading="$loading ?? false"
                >
                    {{ $isEdit ? 'Update App' : 'Create App' }}
                </x-mary-button>
            </div>
        </div>

        <!-- Sidebar -->
        <livewire:partials.admin.right-sidebar />
    </div>
</div>

<script>
function copyToClipboard(text, type) {
    navigator.clipboard.writeText(text).then(function() {
        // Dispatch Livewire event for toast notification
        Livewire.dispatch('toast', {
            type: 'success',
            title: type + ' copied!',
            description: 'The ' + type.toLowerCase() + ' has been copied to your clipboard.',
            position: 'bottom-right'
        });
    }).catch(function(err) {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);

        Livewire.dispatch('toast', {
            type: 'success',
            title: type + ' copied!',
            description: 'The ' + type.toLowerCase() + ' has been copied to your clipboard.',
            position: 'bottom-right'
        });
    });
}

// Listen for the copy-to-clipboard event from Livewire
document.addEventListener('livewire:init', () => {
    Livewire.on('copy-to-clipboard', (event) => {
        copyToClipboard(event.text, event.type);
    });
});
</script>
