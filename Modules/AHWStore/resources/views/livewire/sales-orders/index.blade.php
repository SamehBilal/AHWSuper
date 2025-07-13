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
        $this->loadSalesOrdersData();
        $this->headers = [
            ['key' => 'date', 'label' => 'Date'],
            ['key' => 'salesorder_number', 'label' => 'Number'],
            ['key' => 'customer_name', 'label' => 'Customer'],
            ['key' => 'paid_status', 'label' => 'Paid'],
            ['key' => 'total', 'label' => 'Amount', 'class' => 'text-right'],
            ['key' => 'delivery_method', 'label' => 'Delivery method'],
            ['key' => 'status', 'label' => 'Status'],
            ['key' => 'actions', 'label' => 'Actions', 'class' => 'text-center'],
        ];
    }

    public function loadSalesOrdersData()
    {
        try {
            $this->loading = true;
            
            // Use cached data if available (cache for 5 minutes)
            $cacheKey = 'ahwstore_sales_orders_data';
            $cachedData = Cache::get($cacheKey);
            
            if ($cachedData) {
                $this->list = collect($cachedData);
                $this->filteredList = $this->list;
                $this->loading = false;
                return;
            }
            
            // Fetch fresh data
            $this->list = collect($this->salesOrders());
            $this->filteredList = $this->list;
            
            // Cache the results for 5 minutes
            Cache::put($cacheKey, $this->list->toArray(), now()->addMinutes(5));
            
            $this->loading = false;
        } catch (Exception $e) {
            $this->loading = false;
            $this->error('Error loading sales orders data: ' . $e->getMessage());
        }
    }

    public function refreshSalesOrders()
    {
        // Clear cache and reload
        Cache::forget('ahwstore_sales_orders_data');
        $this->loadSalesOrdersData();
        $this->success('Sales orders refreshed successfully!');
    }

    public function salesOrders()
    {
        try {
            $response = $this->zohoRequest('salesorders');
            $data = $response->json();
            $orders = $data['salesorders'] ?? [];

            // Transform the data to include the new columns and combine totals
            return collect($orders)->map(function ($order) {
                $subTotal = $order['sub_total'] ?? 0;
                $taxTotal = $order['tax_total'] ?? 0;
                $total = $order['total'] ?? 0;
                $delivery_method = $order['delivery_method'] ?? '';
                $currency_code = $order['currency_code'] ?? 'USD';
                $paid_status = $order['paid_status'] ?? 'unpaid';
                
                // Format date
                $date = $order['date'] ?? '';
                $formattedDate = $date ? \Carbon\Carbon::parse($date)->format('M d, Y') : '-';
                
                // Format total with currency code
                $formattedTotal = $currency_code . ' ' . number_format($total, 2);
                
                // Format paid status - capitalize first letter
                $formattedPaidStatus = ucfirst(str_replace('_', ' ', $paid_status));
                
                // Format actions - pass the order ID for the buttons
                $actions = $order['salesorder_id'] ?? '';
                
                return [
                    'salesorder_id' => $order['salesorder_id'] ?? '',
                    'salesorder_number' => $order['salesorder_number'] ?? '',
                    'status' => $order['status'] ?? '-',
                    'date' => $formattedDate,
                    'customer_name' => $order['customer_name'] ?? '-',
                    'sub_total' => $subTotal,
                    'tax_total' => $taxTotal,
                    'delivery_method' => $delivery_method,
                    'paid_status' => $formattedPaidStatus,
                    'total' => $formattedTotal,
                    'currency_code' => $currency_code,
                    'actions' => $actions,
                ];
            })->toArray();
        } catch (Exception $e) {
            return [];
            $this->error('Error', 'Failed to load sales orders: ' . $e->getMessage());
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
            return str_contains(strtolower($order['salesorder_number']), $searchTerm) ||
                   str_contains(strtolower($order['customer_name']), $searchTerm) ||
                   str_contains(strtolower($order['delivery_method']), $searchTerm) ||
                   str_contains(strtolower(strip_tags($order['status'])), $searchTerm) ||
                   str_contains(strtolower($order['salesorder_id']), $searchTerm) ||
                   str_contains(strtolower($order['date']), $searchTerm);
        });
    }

    public function viewOrder($orderId)
    {
        // Redirect to view page or open modal
        $this->info('Viewing order: ' . $orderId, position: 'bottom-right');
        // You can redirect to a view page: return redirect()->route('ahwstore.sales-orders.show', $orderId);
    }

    public function editOrder($orderId)
    {
        // Redirect to edit page or open modal
        $this->warning('Editing order: ' . $orderId, position: 'bottom-right');
        // You can redirect to an edit page: return redirect()->route('ahwstore.sales-orders.edit', $orderId);
    }

    public function deleteOrder($orderId)
    {
        // Show confirmation dialog and delete
        $this->error('Deleting order: ' . $orderId, position: 'bottom-right');
        // You can implement actual deletion logic here
        // After successful deletion, refresh the list
        $this->refreshSalesOrders();
    }
};

?>

<div>
    <section class="w-full">
        <x-mary-header icon="o-shopping-cart" icon-classes="bg-primary text-white rounded-full p-1 w-6 h-6" title="Sales Orders"
            subtitle="List of all the sales orders" separator progress-indicator="save"
            progress-indicator-class="progress-primary">
            <x-slot:middle class="!justify-end">
                <x-mary-input wire:model.live="search" icon="o-magnifying-glass" placeholder="Search sales orders..." />
            </x-slot:middle>
            <x-slot:actions>
                <x-mary-button wire:click="refreshSalesOrders" icon="o-arrow-path" class="btn-sm" 
                    :loading="$loading" title="Refresh Sales Orders" />
                <x-mary-button icon="o-funnel" />
                <x-mary-button link="{{ route('ahwstore.sales-orders.create') }}" icon="o-plus" class="btn-primary" />
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
                                default => 'badge-neutral'
                            };
                        @endphp
                        <x-mary-badge :value="$row['status']" class="{{ $statusClass }} badge-sm" />
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                @endscope
                
                {{-- Paid status column styling --}}
                @scope('cell_paid_status', $row)
                    @php
                        $paidStatus = $row['paid_status'];
                        $progressValue = match(strtolower($paidStatus)) {
                            'paid' => 100,
                            'partially paid' => 50,
                            default => 0
                        };
                        $colorClass = match(strtolower($paidStatus)) {
                            'paid' => 'success',
                            'partially paid' => 'warning',
                            default => 'error'
                        };
                    @endphp
                    <div class="flex items-center gap-2">
                        <x-mary-progress-radial value="{{ $progressValue }}" class="text-white {{ 'bg-'.$colorClass }} text-xs "  style="--size:2rem; --thickness: 1px" />
                        <span class="{{ $colorClass }} font-medium"></span>
                    </div>
                @endscope

                 {{-- Total column styling with breakdown --}}
                 @scope('cell_total', $row)
                    
                     <div class="text-right">
                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $row['total'] }}
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            <div>Subtotal: {{ $row['currency_code'] ?? 'USD' }} {{ number_format($row['sub_total'], 2) }}</div>
                            <div>Tax: {{ $row['currency_code'] ?? 'USD' }} {{ number_format($row['tax_total'], 2) }}</div>
                        </div>
                    </div>
                 @endscope
                
                {{-- Actions column styling --}}
                @scope('cell_actions', $row)
                    <div class="flex gap-1 justify-center">
                        <x-mary-button 
                            class="btn-sm btn-ghost hover:btn-info" 
                            title="View Sales Order" 
                            wire:click="viewOrder('{{ $row['salesorder_id'] }}')"
                            icon="o-eye"
                        />
                        <x-mary-button 
                            class="btn-sm btn-ghost hover:btn-warning" 
                            title="Edit Sales Order" 
                            wire:click="editOrder('{{ $row['salesorder_id'] }}')"
                            icon="o-pencil"
                        />
                        <x-mary-button 
                            class="btn-sm btn-ghost hover:btn-error" 
                            title="Delete Sales Order" 
                            wire:click="deleteOrder('{{ $row['salesorder_id'] }}')"
                            icon="o-trash"
                        />
                    </div>
                @endscope
            </x-mary-table>
        @endif
    </section>
</div>

