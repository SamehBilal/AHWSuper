<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;
use Livewire\WithPagination;
use Modules\Store\Http\Traits\ZohoApiTrait;
use Illuminate\Support\Facades\Cache;

new #[Layout('store::components.layouts.admin', ['pageTitle' => 'Arabhardware | App Testers'])] class extends Component {
    use Toast, ZohoApiTrait;
    use WithPagination;

    public bool $myModal1 = false;
    public $list;
    public $headers;
    public $search = '';
    public $filteredList;
    public $loading = false;

    public function mount()
    {
        $this->loadCustomersData();
        $this->headers = [
            ['key' => 'avatar', 'label' => '', 'class' => 'w-12'],
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'company_name', 'label' => 'Company Name'],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'work_phone', 'label' => 'Work Phone'],
            ['key' => 'status', 'label' => 'Status'],
            ['key' => 'actions', 'label' => 'Actions', 'class' => 'text-center'],
        ];
    }

    public function loadCustomersData()
    {
        try {
            $this->loading = true;

            // Use cached data if available (cache for 5 minutes)
            $cacheKey = 'store_customers_data';
            $cachedData = Cache::get($cacheKey);

            if ($cachedData) {
                $this->list = collect($cachedData);
                $this->filteredList = $this->list;
                $this->loading = false;
                return;
            }

            // Fetch fresh data
            $this->list = collect($this->contacts());
            $this->filteredList = $this->list;

            // Cache the results for 5 minutes
            Cache::put($cacheKey, $this->list->toArray(), now()->addMinutes(5));

            $this->loading = false;
        } catch (Exception $e) {
            $this->loading = false;
            $this->error('Error loading customers data: ' . $e->getMessage());
        }
    }

    public function refreshCustomers()
    {
        // Clear cache and reload
        Cache::forget('store_customers_data');
        $this->loadCustomersData();
        $this->success('Customers refreshed successfully!');
    }

    public function contacts()
    {
        try {
            $response = $this->zohoRequest('contacts');
            $data = $response->json();
            $contacts = $data['contacts'] ?? [];

            // Transform the data to include the new columns
            return collect($contacts)->map(function ($contact) {
                $name = $contact['contact_name'] ?? '-';
                $companyName = $contact['company_name'] ?? '-';
                $email = $contact['email'] ?? '-';
                $workPhone = $contact['phone'] ?? '-';
                $status = $contact['status'] ?? 'active';
                $contactId = $contact['contact_id'] ?? '';

                // Format status - capitalize first letter
                $formattedStatus = ucfirst($status);

                return [
                    'contact_id' => $contactId,
                    'name' => $name,
                    'company_name' => $companyName,
                    'email' => $email,
                    'work_phone' => $workPhone,
                    'status' => $formattedStatus,
                    'avatar' => $contactId, // We'll use this for the avatar
                    'actions' => $contactId, // Pass the contact ID for the buttons
                ];
            })->toArray();
        } catch (Exception $e) {
            return [];
            $this->error('Error', 'Failed to load customers: ' . $e->getMessage());
        }
    }

    public function updatedSearch()
    {
        if (empty($this->search)) {
            $this->filteredList = $this->list;
            return;
        }

        $this->filteredList = $this->list->filter(function ($contact) {
            $searchTerm = strtolower($this->search);
            return str_contains(strtolower($contact['name']), $searchTerm) ||
                   str_contains(strtolower($contact['company_name']), $searchTerm) ||
                   str_contains(strtolower($contact['email']), $searchTerm) ||
                   str_contains(strtolower($contact['work_phone']), $searchTerm) ||
                   str_contains(strtolower($contact['status']), $searchTerm) ||
                   str_contains(strtolower($contact['contact_id']), $searchTerm);
        });
    }

    public function viewCustomer($contactId)
    {
        // Redirect to view page or open modal
        $this->info('Viewing customer: ' . $contactId, position: 'bottom-right');
        // You can redirect to a view page: return redirect()->route('store.customers.show', $contactId);
    }

    public function editCustomer($contactId)
    {
        // Redirect to edit page or open modal
        $this->warning('Editing customer: ' . $contactId, position: 'bottom-right');
        // You can redirect to an edit page: return redirect()->route('store.customers.edit', $contactId);
    }

    public function deleteCustomer($contactId)
    {
        // Show confirmation dialog and delete
        $this->error('Deleting customer: ' . $contactId, position: 'bottom-right');
        // You can implement actual deletion logic here
        // After successful deletion, refresh the list
        $this->refreshCustomers();
    }
};

?>

<div>
    <section class="w-full">
        <x-mary-header icon="o-user-group" icon-classes="bg-primary text-white rounded-full p-1 w-6 h-6" title="Customers"
            subtitle="List of all the contacts" separator progress-indicator="save"
            progress-indicator-class="progress-primary">
            <x-slot:middle class="!justify-end">
                <x-mary-input wire:model.live="search" icon="o-magnifying-glass" placeholder="Search customers..." />
            </x-slot:middle>
            <x-slot:actions>
                <x-mary-button wire:click="refreshCustomers" icon="o-arrow-path" class="btn-sm"
                    :loading="$loading" title="Refresh Customers" />
                <x-mary-button icon="o-funnel" />
                <x-mary-button wire:click="save" icon="o-plus" class="btn-primary" />
            </x-slot:actions>
        </x-mary-header>

        @if($loading)
            <div class="flex items-center justify-center h-32">
                <div class="loading loading-spinner loading-lg text-primary"></div>
            </div>
        @else
            <x-mary-table :headers="$headers" :rows="$filteredList" class="table-zebra">
                {{-- Avatar column styling --}}
                @scope('cell_avatar', $row)
                    @php
                        // Consistent random number for each contact
                        $avatarNumber = (hexdec(substr(md5($row['contact_id']), 0, 4)) % 100) + 1;
                    @endphp
                    <div class="flex items-center justify-center w-10 h-10 rounded-full overflow-hidden  bg-white">
                        <img
                            src="https://avatar.iran.liara.run/public/{{ $avatarNumber }}"
                            alt="Customer Avatar"
                            class="w-10 h-10 object-cover"
                            onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGNpcmNsZSBjeD0iMjAiIGN5PSIyMCIgcj0iMjAiIGZpbGw9IiM2QjcyODAiLz4KPHBhdGggZD0iTTIwIDEwQzIyLjIwOTEgMTAgMjQgMTEuNzkwOSAyNCAxNEMyNCAxNi4yMDkxIDIyLjIwOTEgMTggMjAgMThDMTcuNzkwOSAxOCAxNiAxNi4yMDkxIDE2IDE0QzE2IDExLjc5MDkgMTcuNzkwOSAxMCAyMCAxMFoiIGZpbGw9IndoaXRlIi8+CjxwYXRoIGQ9Ik0yOCAyNkMyOCAyOS4zMTM3IDI0LjQxODMgMzIgMjAgMzJDMTUuNTgxNyAzMiAxMiAyOS4zMTM3IDEyIDI2QzEyIDIyLjY4NjMgMTUuNTgxNyAxOSAyMCAxOUMyNC40MTgzIDE5IDI4IDIyLjY4NjMgMjggMjZaIiBmaWxsPSJ3aGl0ZSIvPgo8L3N2Zz4K'"
                        />
                    </div>
                @endscope

                {{-- Status column styling --}}
                @scope('cell_status', $row)
                    @if($row['status'] && $row['status'] !== '-')
                        @php
                            $statusClass = match(strtolower($row['status'])) {
                                'active' => 'badge-success',
                                'inactive' => 'badge-error',
                                'draft' => 'badge-neutral',
                                'pending' => 'badge-warning',
                                'verified' => 'badge-info',
                                default => 'badge-neutral'
                            };
                        @endphp
                        <x-mary-badge :value="$row['status']" class="{{ $statusClass }} badge-sm" />
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                @endscope

                {{-- Actions column styling --}}
                @scope('cell_actions', $row)
                    <div class="flex gap-1 justify-center">
                        <x-mary-button
                            class="btn-sm btn-ghost hover:btn-info"
                            title="View Customer"
                            wire:click="viewCustomer('{{ $row['contact_id'] }}')"
                            icon="o-eye"
                        />
                        <x-mary-button
                            class="btn-sm btn-ghost hover:btn-warning"
                            title="Edit Customer"
                            wire:click="editCustomer('{{ $row['contact_id'] }}')"
                            icon="o-pencil"
                        />
                        <x-mary-button
                            class="btn-sm btn-ghost hover:btn-error"
                            title="Delete Customer"
                            wire:click="deleteCustomer('{{ $row['contact_id'] }}')"
                            icon="o-trash"
                        />
                    </div>
                @endscope
            </x-mary-table>
        @endif
    </section>
</div>
