<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Mary\Traits\Toast;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Modules\Developers\Models\Ticket;

new #[Layout('developers::components.layouts.admin', ['pageTitle' => 'Arabhardware | My Problems'])] class extends Component {
    use Toast;
    use WithPagination;
    use WithFileUploads;

    // Problem Report Properties
    public bool $showModal = false;
    public $title = '';
    public $category = '';
    public $priority = 'medium';
    public $description = '';
    public $steps_to_reproduce = '';
    public $expected_behavior = '';
    public $actual_behavior = '';
    public $environment_details = '';
    public $api_endpoint = '';
    public $error_message = '';
    public $attachments = [];
    public $contact_email = '';

    // Problem Reports List
    public $problems = [];
    public $selectedProblem = null;
    public bool $showDetailsModal = false;

    // Filter and Search
    public $search = '';
    public $statusFilter = 'all';
    public $categoryFilter = 'all';

    // Categories and Priorities
    public $categories = [
        'api' => 'API Issues',
        'authentication' => 'Authentication',
        'documentation' => 'Documentation',
        'sdk' => 'SDK/Libraries',
        'performance' => 'Performance',
        'billing' => 'Billing',
        'feature_request' => 'Feature Request',
        'other' => 'Other',
    ];

    public $priorities = [
        'low' => 'Low',
        'medium' => 'Medium',
        'high' => 'High',
        'critical' => 'Critical',
    ];

    public $statuses = [
        'open' => 'Open',
        'in_progress' => 'In Progress',
        'resolved' => 'Resolved',
        'closed' => 'Closed',
    ];

    public function mount()
    {
        $this->loadProblems();
        $this->contact_email = Auth::user()->email ?? '';
    }

    public function loadProblems()
    {
        try {
            $user = Auth::user();

            $query = Ticket::where('user_id', $user->id)
                ->when($this->search, function ($q) {
                    $q->where(function ($query) {
                        $query
                            ->where('title', 'like', '%' . $this->search . '%')
                            ->orWhere('description', 'like', '%' . $this->search . '%')
                            ->orWhere('ticket_number', 'like', '%' . $this->search . '%');
                    });
                })
                ->when($this->statusFilter !== 'all', function ($q) {
                    $q->where('status', $this->statusFilter);
                })
                ->when($this->categoryFilter !== 'all', function ($q) {
                    $q->where('category', $this->categoryFilter);
                })
                ->orderBy('created_at', 'desc');

            $this->problems = $query->get();
        } catch (Exception $e) {
            $this->error('Error loading OAuth problems: ' . $e->getMessage(), position: 'bottom-right');
        }
    }

    public function submitProblem()
    {
        $user = Auth::user();

        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(array_keys($this->categories))],
            'priority' => ['required', Rule::in(array_keys($this->priorities))],
            'description' => ['required', 'string', 'min:10'],
            'contact_email' => ['required', 'email'],
            'steps_to_reproduce' => ['nullable', 'string'],
            'expected_behavior' => ['nullable', 'string'],
            'actual_behavior' => ['nullable', 'string'],
            'environment_details' => ['nullable', 'string'],
            'api_endpoint' => ['nullable', 'url'],
            'error_message' => ['nullable', 'string'],
            'attachments.*' => ['nullable', 'file', 'max:10240'], // 10MB max per file
        ]);

        // Generate unique ticket number
        $ticketNumber = 'DEV-' . strtoupper(Str::random(8));

        // Handle file uploads
        $uploadedFiles = [];
        if ($this->attachments) {
            foreach ($this->attachments as $file) {
                $path = $file->store('developer-problems/' . $user->id, 'private');
                $uploadedFiles[] = [
                    'original_name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                ];
            }
        }

        // Create problem record
        $problemId = Ticket::insertGetId([
            'user_id' => $user->id,
            'ticket_number' => $ticketNumber,
            'title' => $this->title,
            'category' => $this->category,
            'priority' => $this->priority,
            'status' => 'open',
            'description' => $this->description,
            'steps_to_reproduce' => $this->steps_to_reproduce,
            'expected_behavior' => $this->expected_behavior,
            'actual_behavior' => $this->actual_behavior,
            'environment_details' => $this->environment_details,
            'api_endpoint' => $this->api_endpoint,
            'error_message' => $this->error_message,
            'contact_email' => $this->contact_email,
            'attachments' => json_encode($uploadedFiles),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Send confirmation email
        $this->sendConfirmationEmail($ticketNumber, $problemId);

        // Reset form
        $this->reset(['title', 'category', 'priority', 'description', 'steps_to_reproduce', 'expected_behavior', 'actual_behavior', 'environment_details', 'api_endpoint', 'error_message', 'attachments']);

        $this->contact_email = Auth::user()->email ?? '';
        $this->showModal = false;
        $this->loadProblems();

        $this->success("Problem reported successfully! Ticket #{$ticketNumber} created.", position: 'bottom-right');
    }

    public function showProblemDetails($problemId)
    {
        $this->selectedProblem = Ticket::where('id', $problemId)->where('user_id', Auth::id())->first();

        if ($this->selectedProblem) {
            $this->selectedProblem->attachments = json_decode($this->selectedProblem->attachments, true) ?? [];
            $this->showDetailsModal = true;
        }
    }

    public function downloadAttachment($attachmentIndex)
    {
        if (!$this->selectedProblem || !isset($this->selectedProblem->attachments[$attachmentIndex])) {
            $this->error('Attachment not found.');
            return;
        }

        $attachment = $this->selectedProblem->attachments[$attachmentIndex];

        if (!Storage::disk('private')->exists($attachment['path'])) {
            $this->error('File not found.');
            return;
        }

        return Storage::disk('private')->download($attachment['path'], $attachment['original_name']);
    }

    public function updatedSearch()
    {
        $this->loadProblems();
    }

    public function updatedStatusFilter()
    {
        $this->loadProblems();
    }

    public function updatedCategoryFilter()
    {
        $this->loadProblems();
    }

    private function sendConfirmationEmail($ticketNumber, $problemId)
    {
        // You can implement email sending logic here
        // Example with Laravel Mail:
        /*
        Mail::to($this->contact_email)->send(new ProblemReportConfirmation([
            'ticket_number' => $ticketNumber,
            'title' => $this->title,
            'user_name' => Auth::user()->name,
            'problem_id' => $problemId
        ]));
        */
    }

    public function getPriorityClass($priority)
    {
        return match ($priority) {
            'low' => 'badge-info',
            'medium' => 'badge-warning',
            'high' => 'badge-error',
            'critical' => 'badge-error badge-outline',
        };
    }

    public function getStatusClass($status)
    {
        return match ($status) {
            'open' => 'badge-primary',
            'in_progress' => 'badge-warning',
            'resolved' => 'badge-success',
            'closed' => 'badge-neutral',
        };
    }
}; ?>
<div class="max-w-7xl mx-auto min-h-screen ">
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <section class="w-full">

                <x-mary-header icon="o-ticket" icon-classes="bg-primary text-white rounded-md p-1 w-6 h-6"
                    title="My Tickets" subtitle="Report problems and track their status" separator progress-indicator="save"
                    progress-indicator-class="progress-primary">
                    <x-slot:middle class="!justify-end">
                        <x-mary-input wire:model.live="search" icon="o-magnifying-glass"
                            placeholder="Search your apps..." />
                    </x-slot:middle>
                    <x-slot:actions>
                        {{-- <x-mary-select wire:model.live="perPage" :options="$perPageOptions" class="w-20 btn-sm" />
                        <x-mary-button wire:click="refreshMyApps" icon="o-arrow-path" class="btn-sm" :loading="$loading"
                            title="Refresh your apps" /> --}}
                        <x-mary-button @click="$wire.showModal = true" {{-- link="{{ route('developers.apps.create') }}" --}} {{-- icon="o-plus" --}}
                            class="btn-primary btn-md" >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        Report Problem
                    </x-mary-button>
                    </x-slot:actions>
                </x-mary-header>

                <!-- Filters -->
                <div class="bg-white rounded-lg shadow-sm border p-4 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <x-mary-input wire:model.live="search" placeholder="Search problems..."
                                icon="o-magnifying-glass" clearable />
                        </div>
                        <div>
                            <x-mary-select wire:model.live="statusFilter" :options="[
                                ['id' => 'all', 'name' => 'All Statuses'],
                                ['id' => 'open', 'name' => 'Open'],
                                ['id' => 'in_progress', 'name' => 'In Progress'],
                                ['id' => 'resolved', 'name' => 'Resolved'],
                                ['id' => 'closed', 'name' => 'Closed'],
                            ]" option-value="id"
                                option-label="name" />
                        </div>
                        <div>
                            <x-mary-select wire:model.live="categoryFilter" :options="array_merge(
                                [['id' => 'all', 'name' => 'All Categories']],
                                collect($categories)
                                    ->map(fn($name, $id) => ['id' => $id, 'name' => $name])
                                    ->values()
                                    ->toArray(),
                            )" option-value="id"
                                option-label="name" />
                        </div>
                        <div class="flex items-end">
                            <button class="btn btn-outline btn-sm" wire:click="loadProblems">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                Refresh
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Problems List -->
                <div class="bg-white rounded-lg shadow-sm border">
                    @if (count($problems) > 0)
                        <div class="overflow-x-auto">
                            <table class="table table-zebra w-full">
                                <thead>
                                    <tr>
                                        <th>Ticket</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($problems as $problem)
                                        <tr>
                                            <td>
                                                <span class="font-mono text-sm">{{ $problem->ticket_number }}</span>
                                            </td>
                                            <td>
                                                <div class="font-medium">{{ Str::limit($problem->title, 50) }}</div>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge badge-outline">{{ $categories[$problem->category] ?? $problem->category }}</span>
                                            </td>
                                            <td>
                                                <span class="badge {{ $this->getPriorityClass($problem->priority) }}">
                                                    {{ ucfirst($problem->priority) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge {{ $this->getStatusClass($problem->status) }}">
                                                    {{ ucfirst(str_replace('_', ' ', $problem->status)) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-sm text-gray-500">
                                                    {{ \Carbon\Carbon::parse($problem->created_at)->format('M j, Y') }}
                                                </span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-ghost"
                                                    wire:click="showProblemDetails({{ $problem->id }})">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-gray-400 mb-4">
                                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No problems reported yet</h3>
                            <p class="text-gray-500 mb-4">Get started by reporting your first problem or issue.</p>
                            <button class="btn btn-primary" @click="$wire.showModal = true">
                                Report Your First Problem
                            </button>
                        </div>
                    @endif
                </div>
            </section>
        </div>

        <!-- Problem Details Modal -->
        <x-mary-modal wire:model="showDetailsModal" title="Problem Details" class="max-w-4xl">
            @if ($selectedProblem)
                <div class="space-y-6">
                    <!-- Header -->
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-semibold">{{ $selectedProblem->title }}</h3>
                            <p class="text-gray-600">Ticket: {{ $selectedProblem->ticket_number }}</p>
                        </div>
                        <div class="text-right">
                            <span class="badge {{ $this->getStatusClass($selectedProblem->status) }} mb-2">
                                {{ ucfirst(str_replace('_', ' ', $selectedProblem->status)) }}
                            </span>
                            <br>
                            <span class="badge {{ $this->getPriorityClass($selectedProblem->priority) }}">
                                {{ ucfirst($selectedProblem->priority) }} Priority
                            </span>
                        </div>
                    </div>

                    <!-- Details Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="font-semibold mb-2">Category</h4>
                            <p>{{ $categories[$selectedProblem->category] ?? $selectedProblem->category }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-2">Contact Email</h4>
                            <p>{{ $selectedProblem->contact_email }}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-2">Created</h4>
                            <p>{{ \Carbon\Carbon::parse($selectedProblem->created_at)->format('M j, Y \a\t g:i A') }}
                            </p>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-2">Last Updated</h4>
                            <p>{{ \Carbon\Carbon::parse($selectedProblem->updated_at)->format('M j, Y \a\t g:i A') }}
                            </p>
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <h4 class="font-semibold mb-2">Description</h4>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="whitespace-pre-wrap">{{ $selectedProblem->description }}</p>
                        </div>
                    </div>

                    <!-- Additional Details -->
                    @if ($selectedProblem->steps_to_reproduce)
                        <div>
                            <h4 class="font-semibold mb-2">Steps to Reproduce</h4>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="whitespace-pre-wrap">{{ $selectedProblem->steps_to_reproduce }}</p>
                            </div>
                        </div>
                    @endif

                    @if ($selectedProblem->expected_behavior || $selectedProblem->actual_behavior)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if ($selectedProblem->expected_behavior)
                                <div>
                                    <h4 class="font-semibold mb-2">Expected Behavior</h4>
                                    <div class="bg-green-50 border border-green-200 p-4 rounded-lg">
                                        <p class="whitespace-pre-wrap">{{ $selectedProblem->expected_behavior }}</p>
                                    </div>
                                </div>
                            @endif
                            @if ($selectedProblem->actual_behavior)
                                <div>
                                    <h4 class="font-semibold mb-2">Actual Behavior</h4>
                                    <div class="bg-red-50 border border-red-200 p-4 rounded-lg">
                                        <p class="whitespace-pre-wrap">{{ $selectedProblem->actual_behavior }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Technical Information -->
                    @if ($selectedProblem->api_endpoint || $selectedProblem->error_message || $selectedProblem->environment_details)
                        <div>
                            <h4 class="font-semibold mb-3">Technical Information</h4>
                            <div class="space-y-3">
                                @if ($selectedProblem->api_endpoint)
                                    <div>
                                        <h5 class="font-medium text-sm text-gray-600">API Endpoint</h5>
                                        <code
                                            class="bg-gray-100 px-2 py-1 rounded">{{ $selectedProblem->api_endpoint }}</code>
                                    </div>
                                @endif
                                @if ($selectedProblem->error_message)
                                    <div>
                                        <h5 class="font-medium text-sm text-gray-600">Error Message</h5>
                                        <pre class="bg-red-50 border border-red-200 p-3 rounded-lg text-sm overflow-x-auto">{{ $selectedProblem->error_message }}</pre>
                                    </div>
                                @endif
                                @if ($selectedProblem->environment_details)
                                    <div>
                                        <h5 class="font-medium text-sm text-gray-600">Environment Details</h5>
                                        <p class="bg-gray-50 p-3 rounded-lg text-sm">
                                            {{ $selectedProblem->environment_details }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Attachments -->
                    @if (!empty($selectedProblem->attachments))
                        <div>
                            <h4 class="font-semibold mb-3">Attachments</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @foreach ($selectedProblem->attachments as $index => $attachment)
                                    <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg">
                                        <div class="flex items-center space-x-3">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                                </path>
                                            </svg>
                                            <div>
                                                <p class="font-medium text-sm">{{ $attachment['original_name'] }}</p>
                                                <p class="text-xs text-gray-500">
                                                    {{ number_format($attachment['size'] / 1024, 1) }} KB</p>
                                            </div>
                                        </div>
                                        <button class="btn btn-sm btn-ghost"
                                            wire:click="downloadAttachment({{ $index }})">
                                            Download
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endif

            <x-slot:actions>
                <x-mary-button label="Close" @click="$wire.showDetailsModal = false" />
            </x-slot:actions>
        </x-mary-modal>

        <!-- Report Problem Modal -->
        <x-mary-modal without-trap-focus wire:model="showModal" title="Report Problem" :subtitle="__('Fill in the details to create a new OAuth app for API access.')"
            class="backdrop-blur">
            <x-mary-form wire:submit="submitProblem" no-separator>
                <div >
                <!-- name of each tab group should be unique -->
                <div class="tabs tabs-lift">
                    <label class="tab">
                        <input type="radio" name="my_tabs_4" checked="checked" />
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-4 me-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
                        </svg>
                        Basic Information
                    </label>
                    <div class="tab-content bg-base-100 border-base-300 p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            <!-- Basic Information -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-semibold mb-3">Basic Information</h3>
                            </div>
                            <x-mary-input label="Problem Title" wire:model="title"
                                placeholder="Brief description of the problem" required />

                            <x-mary-input label="Contact Email" wire:model="contact_email" type="email"
                                placeholder="your@email.com" required />

                            <x-mary-select label="Category" wire:model="category" :options="collect($categories)
                                ->map(fn($name, $id) => ['id' => $id, 'name' => $name])
                                ->values()
                                ->toArray()" option-value="id"
                                option-label="name" placeholder="Select category" required />

                            <x-mary-select label="Priority" wire:model="priority" :options="collect($priorities)
                                ->map(fn($name, $id) => ['id' => $id, 'name' => $name])
                                ->values()
                                ->toArray()" option-value="id"
                                option-label="name" required />
                        </div>
                    </div>

                    <label class="tab">
                        <input type="radio" name="my_tabs_4" />
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-4 me-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                        </svg>
                        Problem Details
                    </label>
                    <div class="tab-content bg-base-100 border-base-300 p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">




                            <!-- Detailed Information -->
                            <div class="md:col-span-2 mt-4">
                                <h3 class="text-lg font-semibold mb-3">Problem Details</h3>
                            </div>
                            <div class="md:col-span-2">
                                <x-mary-textarea label="Description" wire:model="description"
                                    placeholder="Detailed description of the problem you're experiencing"
                                    rows="4" required />
                            </div>

                            <div class="md:col-span-2">
                                <x-mary-textarea label="Steps to Reproduce" wire:model="steps_to_reproduce"
                                    placeholder="1. First step&#10;2. Second step&#10;3. Third step..."
                                    rows="3" />
                            </div>

                            <x-mary-textarea label="Expected Behavior" wire:model="expected_behavior"
                                placeholder="What should happen?" rows="3" />

                            <x-mary-textarea label="Actual Behavior" wire:model="actual_behavior"
                                placeholder="What actually happens?" rows="3" />
                        </div>
                    </div>

                    <label class="tab">
                        <input type="radio" name="my_tabs_4" />
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-4 me-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>
                        Technical Information
                    </label>
                    <div class="tab-content bg-base-100 border-base-300 p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">



                            <!-- Technical Information -->
                            <div class="md:col-span-2 mt-4">
                                <h3 class="text-lg font-semibold mb-3">Technical Information</h3>
                            </div>
                            <x-mary-input label="API Endpoint (if applicable)" wire:model="api_endpoint"
                                placeholder="https://api.example.com/endpoint" />

                            <div class="md:col-span-1"></div>

                            <div class="md:col-span-2">
                                <x-mary-textarea label="Error Message" wire:model="error_message"
                                    placeholder="Copy and paste any error messages here" rows="3" />
                            </div>

                            <div class="md:col-span-2">
                                <x-mary-textarea label="Environment Details" wire:model="environment_details"
                                    placeholder="OS, browser, SDK version, programming language, etc."
                                    rows="3" />
                            </div>

                            <!-- File Attachments -->
                            <div class="md:col-span-2 mt-4">
                                <x-mary-file label="Attachments" wire:model="attachments" multiple
                                    accept="image/*,.pdf,.txt,.log,.json,.xml"
                                    hint="Screenshots, logs, or other relevant files (max 10MB per file)" />
                            </div>
                        </div>
                    </div>
                </div>
                </div>

                <x-slot:actions>
                    <x-mary-button label="Cancel" @click="$wire.showModal = false" />
                    <x-mary-button label="Submit Problem Report" class="btn-primary" type="submit" spinner />
                </x-slot:actions>
            </x-mary-form>
        </x-mary-modal>

        <!-- Sidebar -->
        <livewire:partials.admin.right-sidebar />
    </div>
</div>
