<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;
use Livewire\WithPagination;
use Modules\AHWStore\Http\Traits\ZohoApiTrait;
use Illuminate\Support\Facades\Cache;

new class extends Component {
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
        $this->loadItemsData();
        $this->headers = [
            ['key' => 'image', 'label' => '', 'class' => 'w-12'],
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'sku', 'label' => 'SKU'],
            ['key' => 'status', 'label' => 'Status'],
            ['key' => 'actions', 'label' => 'Actions', 'class' => 'text-center'],
        ];
    }

    public function loadItemsData()
    {
        try {
            $this->loading = true;
            
            // Use cached data if available (cache for 5 minutes)
            $cacheKey = 'ahwstore_items_data';
            $cachedData = Cache::get($cacheKey);
            
            if ($cachedData) {
                $this->list = collect($cachedData);
                $this->filteredList = $this->list;
                $this->loading = false;
                return;
            }
            
            // Fetch fresh data
            $this->list = collect($this->items());
            $this->filteredList = $this->list;
            
            // Cache the results for 5 minutes
            Cache::put($cacheKey, $this->list->toArray(), now()->addMinutes(5));
            
            $this->loading = false;
        } catch (Exception $e) {
            $this->loading = false;
            $this->error('Error loading items data: ' . $e->getMessage());
        }
    }

    public function refreshItems()
    {
        // Clear cache and reload
        Cache::forget('ahwstore_items_data');
        $this->loadItemsData();
        $this->success('Items refreshed successfully!');
    }

    public function items()
    {
        try {
            $response = $this->zohoRequest('items');
            $data = $response->json();
            $items = $data['items'] ?? [];

            // Transform the data to include the new columns
            return collect($items)->map(function ($item) {
                $status = $item['status'] ?? 'active';
                $name = $item['name'] ?? '-';
                $sku = $item['sku'] ?? '-';
                $itemId = $item['item_id'] ?? '';
                
                // Format status - capitalize first letter
                $formattedStatus = ucfirst($status);
                
                return [
                    'item_id' => $itemId,
                    'name' => $name,
                    'sku' => $sku,
                    'status' => $formattedStatus,
                    'image' => $itemId, // We'll use this for the icon
                    'actions' => $itemId, // Pass the item ID for the buttons
                ];
            })->toArray();
        } catch (Exception $e) {
            return [];
            $this->error('Error', 'Failed to load items: ' . $e->getMessage());
        }
    }

    public function updatedSearch()
    {
        if (empty($this->search)) {
            $this->filteredList = $this->list;
            return;
        }
        
        $this->filteredList = $this->list->filter(function ($item) {
            $searchTerm = strtolower($this->search);
            return str_contains(strtolower($item['name']), $searchTerm) ||
                   str_contains(strtolower($item['sku']), $searchTerm) ||
                   str_contains(strtolower($item['status']), $searchTerm) ||
                   str_contains(strtolower($item['item_id']), $searchTerm);
        });
    }

    public function viewItem($itemId)
    {
        // Redirect to view page or open modal
        $this->info('Viewing item: ' . $itemId, position: 'bottom-right');
        // You can redirect to a view page: return redirect()->route('ahwstore.items.show', $itemId);
    }

    public function editItem($itemId)
    {
        // Redirect to edit page or open modal
        $this->warning('Editing item: ' . $itemId, position: 'bottom-right');
        // You can redirect to an edit page: return redirect()->route('ahwstore.items.edit', $itemId);
    }

    public function deleteItem($itemId)
    {
        // Show confirmation dialog and delete
        $this->error('Deleting item: ' . $itemId, position: 'bottom-right');
        // You can implement actual deletion logic here
        // After successful deletion, refresh the list
        $this->refreshItems();
    }
};

?>

<div>
    <section class="w-full">
        <x-mary-header icon="o-shopping-cart" icon-classes="bg-primary text-white rounded-full p-1 w-6 h-6" title="Items"
            subtitle="List of all the items" separator progress-indicator="save"
            progress-indicator-class="progress-primary">
            <x-slot:middle class="!justify-end">
                <x-mary-input wire:model.live="search" icon="o-magnifying-glass" placeholder="Search items..." />
            </x-slot:middle>
            <x-slot:actions>
                <x-mary-button wire:click="refreshItems" icon="o-arrow-path" class="btn-sm" 
                    :loading="$loading" title="Refresh Items" />
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
                {{-- Image/Icon column styling --}}
                @scope('cell_image', $row)
                    <div class="flex items-center justify-center">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                            <x-mary-icon name="o-shopping-bag" class="w-6 h-6 text-primary" />
                        </div>
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
                            title="View Item" 
                            wire:click="viewItem('{{ $row['item_id'] }}')"
                            icon="o-eye"
                        />
                        <x-mary-button 
                            class="btn-sm btn-ghost hover:btn-warning" 
                            title="Edit Item" 
                            wire:click="editItem('{{ $row['item_id'] }}')"
                            icon="o-pencil"
                        />
                        <x-mary-button 
                            class="btn-sm btn-ghost hover:btn-error" 
                            title="Delete Item" 
                            wire:click="deleteItem('{{ $row['item_id'] }}')"
                            icon="o-trash"
                        />
                    </div>
                @endscope
            </x-mary-table>
        @endif
    </section>
</div>
