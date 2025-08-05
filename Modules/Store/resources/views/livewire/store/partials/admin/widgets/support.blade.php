<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;
use Modules\Developers\Models\Ticket;

new class extends Component {
    use Toast;
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

    // Categories and Priorities
    public $categories = [
        'api' => 'API Issues',
        'authentication' => 'Authentication',
        'documentation' => 'Documentation',
        'sdk' => 'SDK/Libraries',
        'performance' => 'Performance',
        'billing' => 'Billing',
        'feature_request' => 'Feature Request',
        'other' => 'Other'
    ];

    public $priorities = [
        'low' => 'Low',
        'medium' => 'Medium',
        'high' => 'High',
        'critical' => 'Critical'
    ];

    public function mount()
    {
        //
    }

    public function report()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        // Logic to handle the support request goes here...

        $this->reset('name');
        $this->success('Support request submitted successfully!', position: 'bottom-right');
        $this->showModal = false;
        $this->dispatch('report-created');
    }
}; ?>

<div>
    <x-mary-card
        class="col-span-2 bg-primary border border-dashed text-white shadow-lg border-base-content/10 border-b-[length:var(--border)] ">
        <x-slot:title>
            <h2 class="card-title text-xl flex gap-1 mb-4">
                <img class="text-red-500 h-8" src="{{ asset('magic.webp') }}" alt="">
                Need Help?
            </h2>
        </x-slot:title>
        <p class="text-sm text-red-100 mb-4">
            Our developer support team is here to help you integrate successfully.
        </p>
        <button class="btn w-full btn-outline btn-sm text-white border-white hover:bg-white hover:text-red-500"
            @click="$wire.showModal = true">
            <i class="fas fa-envelope mr-2"></i>
            Contact Support
        </button>
    </x-mary-card>

    <!-- Report Problem Modal -->
        <x-mary-modal without-trap-focus wire:model="showModal" title="Report Problem" :subtitle="__('Fill in the details to create a new OAuth app for API access.')"
            class="backdrop-blur">
            <x-mary-form wire:submit="submitProblem" no-separator>
                <div >
                <!-- name of each tab group should be unique -->
                <div class="tabs tabs-lift">
                    <label class="tab">
                        <input type="radio" name="my_tabs_4" checked="checked"  />
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
</div>
