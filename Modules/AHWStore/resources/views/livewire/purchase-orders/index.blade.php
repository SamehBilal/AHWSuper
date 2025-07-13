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
        $this->loadPurchaseOrdersData();
        $this->headers = [
            ['key' => 'date', 'label' => 'Date'],
            ['key' => 'purchaseorder_number', 'label' => 'PO Number'],
            ['key' => 'reference_number', 'label' => 'Reference'],
            ['key' => 'vendor_name', 'label' => 'Vendor'],
            ['key' => 'status', 'label' => 'Status'],
            ['key' => 'total', 'label' => 'Total', 'class' => 'text-right'],
            ['key' => 'actions', 'label' => 'Actions', 'class' => 'text-center'],
        ];
    }

    public function loadPurchaseOrdersData()
    {
        try {
            $this->loading = true;
            
            // Use cached data if available (cache for 5 minutes)
            $cacheKey = 'ahwstore_purchase_orders_data';
            $cachedData = Cache::get($cacheKey);
            
            if ($cachedData) {
                $this->list = collect($cachedData);
                $this->filteredList = $this->list;
                $this->loading = false;
                return;
            }
            
            // Fetch fresh data
            $this->list = collect($this->purchaseOrders());
            $this->filteredList = $this->list;
            
            // Cache the results for 5 minutes
            Cache::put($cacheKey, $this->list->toArray(), now()->addMinutes(5));
            
            $this->loading = false;
        } catch (Exception $e) {
            $this->loading = false;
            $this->error('Error loading purchase orders data: ' . $e->getMessage());
        }
    }

    public function refreshPurchaseOrders()
    {
        // Clear cache and reload
        Cache::forget('ahwstore_purchase_orders_data');
        $this->loadPurchaseOrdersData();
        $this->success('Purchase orders refreshed successfully!');
    }

    public function purchaseOrders()
    {
        try {
            $response = $this->zohoRequest('purchaseorders');
            $data = $response->json();
            $orders = $data['purchaseorders'] ?? [];

            // Transform the data to include the new columns
            return collect($orders)->map(function ($order) {
                $date = $order['date'] ?? '';
                $formattedDate = $date ? \Carbon\Carbon::parse($date)->format('M d, Y') : '-';
                
                $purchaseorderNumber = $order['purchaseorder_number'] ?? '-';
                $referenceNumber = $order['reference_number'] ?? '-';
                $vendorName = $order['vendor_name'] ?? '-';
                $status = $order['status'] ?? '-';
                $total = $order['total'] ?? 0;
                $currencyCode = $order['currency_code'] ?? 'USD';
                $purchaseorderId = $order['purchaseorder_id'] ?? '';
                
                // Format total with currency code
                $formattedTotal = $currencyCode . ' ' . number_format($total, 2);
                
                // Format status - capitalize and replace underscores
                $formattedStatus = ucwords(str_replace('_', ' ', $status));
                
                return [
                    'purchaseorder_id' => $purchaseorderId,
                    'date' => $formattedDate,
                    'purchaseorder_number' => $purchaseorderNumber,
                    'reference_number' => $referenceNumber,
                    'vendor_name' => $vendorName,
                    'status' => $formattedStatus,
                    'total' => $formattedTotal,
                    'currency_code' => $currencyCode,
                    'actions' => $purchaseorderId, // Pass the order ID for the buttons
                ];
            })->toArray();
        } catch (Exception $e) {
            return [];
            $this->error('Error', 'Failed to load purchase orders: ' . $e->getMessage());
        }
    }

    public function updatedSearch()
    {
        if (empty($this->search)) {
            $this->filteredList = $this->list;
            return;
        }
        
        $this->filteredList = $this->list->filter(function ($order) {
            $searchTerm = strtolower($this->search);
            return str_contains(strtolower($order['purchaseorder_number']), $searchTerm) ||
                   str_contains(strtolower($order['reference_number']), $searchTerm) ||
                   str_contains(strtolower($order['vendor_name']), $searchTerm) ||
                   str_contains(strtolower(strip_tags($order['status'])), $searchTerm) ||
                   str_contains(strtolower($order['purchaseorder_id']), $searchTerm) ||
                   str_contains(strtolower($order['date']), $searchTerm);
        });
    }

    public function viewOrder($orderId)
    {
        // Redirect to view page or open modal
        $this->info('Viewing purchase order: ' . $orderId, position: 'bottom-right');
        // You can redirect to a view page: return redirect()->route('ahwstore.purchase-orders.show', $orderId);
    }

    public function editOrder($orderId)
    {
        // Redirect to edit page or open modal
        $this->warning('Editing purchase order: ' . $orderId, position: 'bottom-right');
        // You can redirect to an edit page: return redirect()->route('ahwstore.purchase-orders.edit', $orderId);
    }

    public function deleteOrder($orderId)
    {
        // Show confirmation dialog and delete
        $this->error('Deleting purchase order: ' . $orderId, position: 'bottom-right');
        // You can implement actual deletion logic here
        // After successful deletion, refresh the list
        $this->refreshPurchaseOrders();
    }
}; ?>

<div>
    <section class="w-full">
        <x-mary-header icon="o-shopping-cart" icon-classes="bg-primary text-white rounded-full p-1 w-6 h-6" title="Purchase Orders"
            subtitle="List of all the purchase orders" separator progress-indicator="save"
            progress-indicator-class="progress-primary">
            <x-slot:middle class="!justify-end">
                <x-mary-input wire:model.live="search" icon="o-magnifying-glass" placeholder="Search purchase orders..." />
            </x-slot:middle>
            <x-slot:actions>
                <x-mary-button wire:click="refreshPurchaseOrders" icon="o-arrow-path" class="btn-sm" 
                    :loading="$loading" title="Refresh Purchase Orders" />
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
                {{-- Status column styling --}}
                @scope('cell_status', $row)
                    @if($row['status'] && $row['status'] !== '-')
                        @php
                            $statusClass = match(strtolower($row['status'])) {
                                'confirmed' => 'badge-success',
                                'pending' => 'badge-warning',
                                'draft' => 'badge-neutral',
                                'cancelled' => 'badge-error',
                                'partially received' => 'badge-info',
                                'received' => 'badge-success',
                                default => 'badge-neutral'
                            };
                        @endphp
                        <x-mary-badge :value="$row['status']" class="{{ $statusClass }} badge-sm" />
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                @endscope
                
                {{-- Total column styling --}}
                @scope('cell_total', $row)
                    <div class="text-right">
                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $row['total'] }}
                        </div>
                    </div>
                @endscope
                
                {{-- Actions column styling --}}
                @scope('cell_actions', $row)
                    <div class="flex gap-1 justify-center">
                        <x-mary-button 
                            class="btn-sm btn-ghost hover:btn-info" 
                            title="View Purchase Order" 
                            wire:click="viewOrder('{{ $row['purchaseorder_id'] }}')"
                            icon="o-eye"
                        />
                        <x-mary-button 
                            class="btn-sm btn-ghost hover:btn-warning" 
                            title="Edit Purchase Order" 
                            wire:click="editOrder('{{ $row['purchaseorder_id'] }}')"
                            icon="o-pencil"
                        />
                        <x-mary-button 
                            class="btn-sm btn-ghost hover:btn-error" 
                            title="Delete Purchase Order" 
                            wire:click="deleteOrder('{{ $row['purchaseorder_id'] }}')"
                            icon="o-trash"
                        />
                    </div>
                @endscope
            </x-mary-table>
        @endif
    </section>
</div>
