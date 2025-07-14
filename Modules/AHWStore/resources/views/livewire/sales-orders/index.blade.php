<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;
use Livewire\WithPagination;
use Modules\AHWStore\Http\Traits\ZohoApiTrait;
use Illuminate\Support\Facades\Cache;

new #[Layout('ahwstore::components.layouts.master')] class extends Component {
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
    public $sortField = 'date';
    public $sortDirection = 'desc';
    public $sortBy = ['column' => 'date', 'direction' => 'desc'];

    public function mount()
    {
        $this->page = 1;
        $this->perPage = 25;
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
            $cacheKey = 'ahwstore_sales_orders_data_' . $this->page . '_' . $this->perPage . '_' . md5($this->search);
            $cachedData = Cache::get($cacheKey);
            
            if ($cachedData) {
                $this->list = collect($cachedData['orders']);
                $this->filteredList = $this->list;
                $this->total = $cachedData['total'] ?? 0;
                $this->hasMorePage = $cachedData['has_more_page'] ?? false;
                $this->loading = false;
                return;
            }
            
            // Fetch fresh data
            $ordersData = $this->salesOrders();
            $this->list = collect($ordersData['orders']);
            $this->filteredList = $this->list;
            $this->total = $ordersData['total'] ?? 0;
            $this->hasMorePage = $ordersData['has_more_page'] ?? false;
            
            // Cache the results for 5 minutes
            Cache::put($cacheKey, ['orders' => $this->list->toArray(), 'total' => $this->total, 'has_more_page' => $this->hasMorePage], now()->addMinutes(5));
            
            $this->loading = false;
        } catch (Exception $e) {
            $this->loading = false;
            $this->error('Error loading sales orders data: ' . $e->getMessage(), position:'bottom-right');
        }
    }

    public function refreshSalesOrders()
    {
        // Clear cache and reload
        $cacheKey = 'ahwstore_sales_orders_data_' . $this->page . '_' . $this->perPage . '_' . md5($this->search);
        Cache::forget($cacheKey);
        $this->loadSalesOrdersData();
        $this->success('Sales orders refreshed successfully!', position:'bottom-right');
    }

    public function salesOrders()
    {
        try {
            $params = [
                'page' => $this->page,
                'per_page' => $this->perPage,
                'sort_column' => $this->sortBy['column'],
                'sort_order' => $this->sortBy['direction'] === 'asc' ? 'A' : 'D',
            ];
            $response = $this->zohoRequest('salesorders', 'get', $params);
            $data = $response->json();
            $orders = $data['salesorders'] ?? [];
            $hasMorePage = $data['page_context']['has_more_page'] ?? false;

            // Transform the data to include the new columns and combine totals
            $transformed = collect($orders)->map(function ($order) {
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
                    'actions' => $order['salesorder_id'] ?? '',
                ];
            })->toArray();
            
            return ['orders' => $transformed, 'has_more_page' => $hasMorePage];
        } catch (Exception $e) {
            return ['orders' => [], 'has_more_page' => false];
            $this->error('Error', 'Failed to load sales orders: ' . $e->getMessage(), position:'bottom-right');
        }
    }

    public function goToPage($page)
    {
        $this->page = $page;
        $this->loadSalesOrdersData();
    }

    public function updatedPerPage()
    {
        $this->page = 1; // Reset to first page when changing per page
        $this->loadSalesOrdersData();
    }
    
    public function updatedSearch()
    {
        $this->page = 1;
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
                   str_contains(strtolower($order['date']), $searchTerm) ||
                   str_contains(strtolower($order['paid_status']), $searchTerm);
        });
    }

    public function updatedSortBy()
    {
        $this->page = 1; // Reset to first page when sorting
        $this->loadSalesOrdersData();
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
                <x-mary-button icon="o-funnel" class="btn-sm" />
                <x-mary-select wire:model.live="perPage" :options="$perPageOptions" class="w-20 btn-sm" />
                <x-mary-button link="{{ route('ahwstore.sales-orders.create') }}" icon="o-plus" class="btn-primary btn-sm" />
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
                                        @if(isset($header['key']) && $header['key'] === 'actions')
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

