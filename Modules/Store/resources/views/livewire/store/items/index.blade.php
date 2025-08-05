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
    public $page = 1;
    public $perPage = 25;
    public $total = 0;
    public $hasMorePage = false;
    public $perPageOptions = [
            ['id' => 10, 'name' => 10],
            ['id' => 25, 'name' => 25],
            ['id' => 50, 'name' => 50],
            ['id' => 100, 'name' => 100]
        ];
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $sortBy = ['column' => 'name', 'direction' => 'asc'];

    public function mount()
    {
        $this->page = 1;
        $this->perPage = 25;
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
            $cacheKey = 'store_items_data_' . $this->page . '_' . $this->perPage . '_' . md5($this->search);
            $cachedData = Cache::get($cacheKey);

            if ($cachedData) {
                $this->list = collect($cachedData['items']);
                $this->filteredList = $this->list;
                $this->total = $cachedData['total'] ?? 0; // not used for controls
                $this->hasMorePage = $cachedData['has_more_page'] ?? false;
                $this->loading = false;
                return;
            }

            // Fetch fresh data
            $itemsData = $this->items();
            $this->list = collect($itemsData['items']);
            $this->filteredList = $this->list;
            $this->total = $itemsData['total'] ?? 0; // not used for controls
            $this->hasMorePage = $itemsData['has_more_page'] ?? false;

            // Cache the results for 5 minutes
            Cache::put($cacheKey, ['items' => $this->list->toArray(), 'total' => $this->total, 'has_more_page' => $this->hasMorePage], now()->addMinutes(5));

            $this->loading = false;
        } catch (Exception $e) {
            $this->loading = false;
            $this->error('Error loading items data: ' . $e->getMessage(), position:'bottom-right');
        }
    }

    public function refreshItems()
    {
        // Clear cache and reload
        $cacheKey = 'store_items_data_' . $this->page . '_' . $this->perPage . '_' . md5($this->search);
        Cache::forget($cacheKey);
        $this->loadItemsData();
        $this->success('Items refreshed successfully!', position:'bottom-right');
    }

    public function items()
    {
        try {
            $params = [
                'page' => $this->page,
                'per_page' => $this->perPage,
                'sort_column' => $this->sortBy['column'],
                'sort_order' => $this->sortBy['direction'] === 'asc' ? 'A' : 'D',
            ];
            $response = $this->zohoRequest('items', 'get', $params);
            $data = $response->json();
            $items = $data['items'] ?? [];
            $hasMorePage = $data['page_context']['has_more_page'] ?? false;
            // Transform the data to include the new columns
            $transformed = collect($items)->map(function ($item) {
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
            return ['items' => $transformed, 'has_more_page' => $hasMorePage];
        } catch (Exception $e) {
            return ['items' => [], 'has_more_page' => false];
            $this->error('Error', 'Failed to load items: ' . $e->getMessage(), position:'bottom-right');
        }
    }

    public function goToPage($page)
    {
        $this->page = $page;
        $this->loadItemsData();
    }

    public function updatedPerPage()
    {
        $this->page = 1; // Reset to first page when changing per page
        $this->loadItemsData();
    }

    public function updatedSearch()
    {
        $this->page = 1;
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

    public function updatedSortBy()
    {
        $this->page = 1; // Reset to first page when sorting
        $this->loadItemsData();
    }

    public function viewItem($itemId)
    {
        // Redirect to view page or open modal
        $this->info('Viewing item: ' . $itemId, position: 'bottom-right');
        // You can redirect to a view page: return redirect()->route('store.items.show', $itemId);
    }

    public function editItem($itemId)
    {
        // Redirect to edit page or open modal
        $this->warning('Editing item: ' . $itemId, position: 'bottom-right');
        // You can redirect to an edit page: return redirect()->route('store.items.edit', $itemId);
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
                <x-mary-button icon="o-funnel" class="btn-sm" />
                <x-mary-select wire:model.live="perPage" :options="$perPageOptions" class="w-20 btn-sm" />
                <x-mary-button wire:click="save" icon="o-plus" class="btn-primary btn-sm" />
            </x-slot:actions>
        </x-mary-header>

        <div wire:loading>
            <div class="w-full">
                <table class="table table-zebra w-full min-w-full">
                    <thead>
                        <tr>
                            @foreach($headers as $header)
                                <th class="{{ $header['class'] ?? '' }}">
                                    <div class="skeleton h-8 w-full min-w-full"></div>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 0; $i < 9; $i++)
                            <tr>
                                @foreach($headers as $header)
                                    <td class="{{ $header['class'] ?? '' }}">
                                        @if(isset($header['key']) && $header['key'] === 'image')
                                            <div class="skeleton h-12 w-12 rounded-lg mx-auto"></div>
                                        @elseif(isset($header['key']) && $header['key'] === 'actions')
                                            <div class="flex gap-1 justify-center">
                                                <div class="skeleton h-10 w-10 rounded"></div>
                                                <div class="skeleton h-10 w-10 rounded"></div>
                                                <div class="skeleton h-10 w-10 rounded"></div>
                                            </div>
                                        @else
                                            <div class="skeleton h-10 w-full min-w-full"></div>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
        <div wire:loading.remove>
            <x-mary-table :headers="$headers" :rows="$filteredList" class="table-zebra" sortable wire:model.live="sortBy">
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
            @if($page > 1 || $hasMorePage)
                <div class="flex justify-end mt-4 min-h-[40px]">
                    @if($loading)
                        <div class="flex items-center justify-center w-full">
                            <span class="loading loading-spinner loading-md text-primary"></span>
                        </div>
                    @else
                        <div class="join">
                            <button class="join-item btn" @if($page == 1) disabled @endif wire:click="goToPage({{ $page - 1 }})">«</button>
                            <button class="join-item btn btn-active">Page {{ $page }}</button>
                            <button class="join-item btn" @if(!$hasMorePage) disabled @endif wire:click="goToPage({{ $page + 1 }})">»</button>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </section>
</div>
