<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;
use Modules\AHWStore\Http\Traits\ZohoApiTrait;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

new #[Layout('ahwstore::components.layouts.master')] class extends Component {
    use Toast, ZohoApiTrait;

    public $pageTitle = 'AHW Store Dashboard';
    public $dashboardData = [];
    public $loading = true;
    public $breadcrumbs;
    public $slides;
    public $selectedDateRange = 'This Month';
    public $topSellingItems = [];
    public $purchaseOrderSummary = [];

    public $dateRanges = [
        'Today' => 'Today',
        'Yesterday' => 'Yesterday', 
        'This Week' => 'This Week',
        'This Month' => 'This Month',
        'This Year' => 'This Year',
        'Previous Week' => 'Previous Week',
        'Previous Month' => 'Previous Month',
        'Previous Year' => 'Previous Year',
        'Custom' => 'Custom'
    ];

    public function mount()
    {
        $this->pageTitle = 'AHW Store Dashboard';
        $this->breadcrumbs = [
            [
                'label' => 'Home',
                'icon' => 'm-home',
                'link' => route('dashboard'),
            ],
            [
                'label' => 'Dashboard',
            ],
        ];

        $this->slides = [
            [
                'image' => asset('ahwstores.webp'),
                'title' => 'AHW Store first',
                'description' => 'We love last week frameworks.',
                'url' => '/docs/installation',
                'urlText' => 'Get started',
            ],
            /* [
                'image' => asset('ahwstores1.webp'),
                'title' => 'Ahw Store second',
                'description' => 'Where burnout is just a fancy term for Tuesday.',
            ], */
            [
                'image' => asset('ahwstores2.webp'),
                'title' => 'Ahw Store third',
                'description' => 'Where burnout is just a fancy term for Tuesday.',
            ],
            [
                'image' => asset('ahwstores3.webp'),
                'title' => 'Ahw Store fourth',
                'description' => 'Where burnout is just a fancy term for Tuesday.',
            ],
            [
                'image' => asset('ahwstores4.webp'),
                'title' => 'Ahw Store fifth',
                'description' => 'Where burnout is just a fancy term for Tuesday.',
            ],
            [
                'image' => asset('ahwstores5.webp'),
                'title' => 'Ahw Store sixth',
                'description' => 'Where burnout is just a fancy term for Tuesday.',
            ],
            [
                'image' => asset('ahwstores6.webp'),
                'title' => 'Ahw Store seventh',
                'description' => 'Where burnout is just a fancy term for Tuesday.',
            ],
        ];
        
        $this->loadDashboardData();
    }

    public function updatedSelectedDateRange()
    {
        $this->loadDashboardData();
    }

    public function getDateRangeDates($range)
    {
        $now = Carbon::now();
        
        return match($range) {
            'Today' => [
                'start' => $now->startOfDay(),
                'end' => $now->endOfDay()
            ],
            'Yesterday' => [
                'start' => $now->subDay()->startOfDay(),
                'end' => $now->subDay()->endOfDay()
            ],
            'This Week' => [
                'start' => $now->startOfWeek(),
                'end' => $now->endOfWeek()
            ],
            'This Month' => [
                'start' => $now->startOfMonth(),
                'end' => $now->endOfMonth()
            ],
            'This Year' => [
                'start' => $now->startOfYear(),
                'end' => $now->endOfYear()
            ],
            'Previous Week' => [
                'start' => $now->subWeek()->startOfWeek(),
                'end' => $now->subWeek()->endOfWeek()
            ],
            'Previous Month' => [
                'start' => $now->subMonth()->startOfMonth(),
                'end' => $now->subMonth()->endOfMonth()
            ],
            'Previous Year' => [
                'start' => $now->subYear()->startOfYear(),
                'end' => $now->subYear()->endOfYear()
            ],
            default => [
                'start' => $now->startOfMonth(),
                'end' => $now->endOfMonth()
            ]
        };
    }

    public function loadDashboardData()
    {
        try {
            $this->loading = true;
            
            // Use cached data if available (cache for 5 minutes)
            $cacheKey = 'ahwstore_dashboard_data_' . $this->selectedDateRange;
            $cachedData = Cache::get($cacheKey);
            
            if ($cachedData) {
                $this->dashboardData = $cachedData;
                $this->loadTopSellingItems();
                $this->loadPurchaseOrderSummary();
                $this->loading = false;
                return;
            }
            
            // Fetch all data in parallel using Guzzle promises
            $this->dashboardData = $this->fetchAllDataInParallel();
            
            // Cache the results for 5 minutes
            Cache::put($cacheKey, $this->dashboardData, now()->addMinutes(5));
            
            $this->loadTopSellingItems();
            $this->loadPurchaseOrderSummary();
            $this->loading = false;
        } catch (Exception $e) {
            $this->loading = false;
            $this->error('Error loading dashboard data: ' . $e->getMessage());
        }
    }

    public function loadTopSellingItems()
    {
        try {
            // Use cached data if available
            $cacheKey = 'ahwstore_top_selling_items_' . $this->selectedDateRange;
            $cachedData = Cache::get($cacheKey);
            
            if ($cachedData) {
                $this->topSellingItems = $cachedData;
                return;
            }
            
            // Fetch sales orders to analyze top selling items
            $salesOrdersResponse = $this->zohoRequest('salesorders');
            $salesOrdersData = $salesOrdersResponse->json();
            $orders = $salesOrdersData['salesorders'] ?? [];
            
            // Get date range for filtering
            $dateRange = $this->getDateRangeDates($this->selectedDateRange);
            $startDate = $dateRange['start'];
            $endDate = $dateRange['end'];
            
            // Filter orders by date range
            $filteredOrders = collect($orders)->filter(function($order) use ($startDate, $endDate) {
                $orderDate = Carbon::parse($order['date'] ?? '');
                return $orderDate->between($startDate, $endDate);
            });
            
            // Extract line items from orders and aggregate by item
            $itemSales = [];
            foreach ($filteredOrders as $order) {
                $lineItems = $order['line_items'] ?? [];
                foreach ($lineItems as $lineItem) {
                    $itemName = $lineItem['name'] ?? '';
                    $quantity = $lineItem['quantity'] ?? 0;
                    $unit = $lineItem['unit'] ?? 'pcs';
                    
                    if ($itemName && $quantity > 0) {
                        if (!isset($itemSales[$itemName])) {
                            $itemSales[$itemName] = [
                                'name' => $itemName,
                                'quantity' => 0,
                                'unit' => $unit
                            ];
                        }
                        $itemSales[$itemName]['quantity'] += $quantity;
                    }
                }
            }
            
            // Sort by quantity and take top 6
            $this->topSellingItems = collect($itemSales)
                ->sortByDesc('quantity')
                ->take(6)
                ->values()
                ->toArray();
            
            // Cache the results
            Cache::put($cacheKey, $this->topSellingItems, now()->addMinutes(5));
            
        } catch (Exception $e) {
            \Log::error('Error loading top selling items: ' . $e->getMessage());
            $this->topSellingItems = [];
        }
    }

    public function loadPurchaseOrderSummary()
    {
        try {
            // Use cached data if available
            $cacheKey = 'ahwstore_purchase_order_summary_' . $this->selectedDateRange;
            $cachedData = Cache::get($cacheKey);
            
            if ($cachedData) {
                $this->purchaseOrderSummary = $cachedData;
                return;
            }
            
            // Fetch purchase orders
            $purchaseOrdersResponse = $this->zohoRequest('purchaseorders');
            $purchaseOrdersData = $purchaseOrdersResponse->json();
            $purchaseOrders = $purchaseOrdersData['purchaseorders'] ?? [];
            
            // Get date range for filtering
            $dateRange = $this->getDateRangeDates($this->selectedDateRange);
            $startDate = $dateRange['start'];
            $endDate = $dateRange['end'];
            
            // Filter purchase orders by date range
            $filteredPurchaseOrders = collect($purchaseOrders)->filter(function($po) use ($startDate, $endDate) {
                $poDate = Carbon::parse($po['date'] ?? '');
                return $poDate->between($startDate, $endDate);
            });
            
            // Calculate summary
            $totalQuantity = 0;
            $totalCost = 0;
            $currency = 'USD'; // Default currency
            
            foreach ($filteredPurchaseOrders as $po) {
                $lineItems = $po['line_items'] ?? [];
                foreach ($lineItems as $lineItem) {
                    $quantity = $lineItem['quantity'] ?? 0;
                    $rate = $lineItem['rate'] ?? 0;
                    
                    $totalQuantity += $quantity;
                    $totalCost += ($quantity * $rate);
                }
                
                // Get currency from first PO
                if (empty($currency) && isset($po['currency_code'])) {
                    $currency = $po['currency_code'];
                }
            }
            
            $this->purchaseOrderSummary = [
                'quantity_ordered' => round($totalQuantity, 2),
                'total_cost' => round($totalCost, 2),
                'currency' => $currency
            ];
            
            // Cache the results
            Cache::put($cacheKey, $this->purchaseOrderSummary, now()->addMinutes(5));
            
        } catch (Exception $e) {
            \Log::error('Error loading purchase order summary: ' . $e->getMessage());
            $this->purchaseOrderSummary = [
                'quantity_ordered' => 0,
                'total_cost' => 0,
                'currency' => 'USD'
            ];
        }
    }

    public function fetchAllDataInParallel()
    {
        try {
            // Make essential API calls to get real data immediately
            $itemsResponse = $this->zohoRequest('items');
            $itemsData = $itemsResponse->json();
            $items = $itemsData['items'] ?? [];

            \Log::info('Items API Response:', [
                'total_items' => count($items),
                'first_item' => $items[0] ?? 'No items found',
                'response_keys' => array_keys($itemsData)
            ]);

            $salesOrdersResponse = $this->zohoRequest('salesorders');
            $salesOrdersData = $salesOrdersResponse->json();
            $orders = $salesOrdersData['salesorders'] ?? [];

            \Log::info('Sales Orders API Response:', [
                'total_orders' => count($orders),
                'first_order' => $orders[0] ?? 'No orders found',
                'response_keys' => array_keys($salesOrdersData)
            ]);

            $invoicesResponse = $this->zohoRequest('invoices');
            $invoicesData = $invoicesResponse->json();
            $invoices = $invoicesData['invoices'] ?? [];

            \Log::info('Invoices API Response:', [
                'total_invoices' => count($invoices),
                'first_invoice' => $invoices[0] ?? 'No invoices found',
                'response_keys' => array_keys($invoicesData)
            ]);

            // Calculate all metrics from real data
            $totalItems = count($items);
            $totalQuantity = collect($items)->sum('available_stock');
            $activeItems = collect($items)->filter(fn($item) => ($item['status'] ?? '') === 'active')->count();
            $activePercentage = $totalItems > 0 ? round(($activeItems / $totalItems) * 100, 1) : 0;
            
            $lowStockItems = collect($items)->filter(function($item) {
                $availableStock = $item['available_stock'] ?? 0;
                $reorderLevel = $item['reorder_level'] ?? 0;
                return $availableStock <= $reorderLevel && $availableStock > 0;
            })->take(5)->map(function($item) {
                return [
                    'id' => $item['item_id'] ?? '',
                    'name' => $item['name'] ?? '',
                    'available_stock' => $item['available_stock'] ?? 0,
                    'reorder_level' => $item['reorder_level'] ?? 0,
                ];
            })->toArray();

            // Calculate sales activity from real data
            $totalOrders = count($orders);
            $pendingInvoices = collect($invoices)->filter(function($invoice) {
                return ($invoice['status'] ?? '') === 'draft' || ($invoice['status'] ?? '') === 'pending';
            })->count();

            $toBePacked = collect($orders)->filter(function($order) {
                return ($order['status'] ?? '') === 'confirmed';
            })->count();

            $toBeShipped = collect($orders)->filter(function($order) {
                return ($order['status'] ?? '') === 'packed';
            })->count();

            $toBeDelivered = collect($orders)->filter(function($order) {
                return ($order['status'] ?? '') === 'shipped';
            })->count();

            $salesActivity = [
                'total_orders' => $totalOrders,
                'to_be_packed' => $toBePacked,
                'to_be_shipped' => $toBeShipped,
                'to_be_delivered' => $toBeDelivered,
                'to_be_invoiced' => $pendingInvoices,
            ];

            $inventorySummary = [
                'quantity_in_hand' => $totalQuantity,
                'quantity_to_be_received' => 0, // Will be updated in background
                'low_stock_items' => count($lowStockItems),
            ];

            $itemDetails = [
                'total_items' => $totalItems,
                'active_items' => $activeItems,
                'active_percentage' => $activePercentage,
                'unconfirmed_items' => 0,
            ];

            // Get recent orders and invoices
            $recentOrders = collect($orders)
                ->take(5)
                ->map(function($order) {
                    return [
                        'id' => $order['salesorder_id'] ?? '',
                        'number' => $order['salesorder_number'] ?? '',
                        'customer' => $order['customer_name'] ?? '',
                        'total' => $order['total'] ?? 0,
                        'status' => $order['status'] ?? '',
                        'date' => $order['date'] ?? '',
                    ];
                })
                ->toArray();

            $recentInvoices = collect($invoices)
                ->take(5)
                ->map(function($invoice) {
                    return [
                        'id' => $invoice['invoice_id'] ?? '',
                        'number' => $invoice['invoice_number'] ?? '',
                        'customer' => $invoice['customer_name'] ?? '',
                        'total' => $invoice['total'] ?? 0,
                        'status' => $invoice['status'] ?? '',
                        'date' => $invoice['date'] ?? '',
                    ];
                })
                ->toArray();

            $finalData = [
                'sales_activity' => $salesActivity,
                'inventory_summary' => $inventorySummary,
                'item_details' => $itemDetails,
                'recent_orders' => $recentOrders,
                'recent_invoices' => $recentInvoices,
                'low_stock_items' => $lowStockItems,
            ];

            \Log::info('Final Dashboard Data:', $finalData);

            // Cache individual components for future use
            Cache::put('ahwstore_sales_activity', $salesActivity, now()->addMinutes(5));
            Cache::put('ahwstore_recent_orders', $recentOrders, now()->addMinutes(5));
            Cache::put('ahwstore_recent_invoices', $recentInvoices, now()->addMinutes(5));

            return $finalData;
        } catch (Exception $e) {
            \Log::error('Dashboard Data Fetch Error:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            
            // Return default data structure
            return [
                'sales_activity' => [
                    'total_orders' => 0,
                    'to_be_packed' => 0,
                    'to_be_shipped' => 0,
                    'to_be_delivered' => 0,
                    'to_be_invoiced' => 0,
                ],
                'inventory_summary' => [
                    'quantity_in_hand' => 0,
                    'quantity_to_be_received' => 0,
                    'low_stock_items' => 0,
                ],
                'item_details' => [
                    'total_items' => 0,
                    'active_items' => 0,
                    'active_percentage' => 0,
                    'unconfirmed_items' => 0,
                ],
                'recent_orders' => [],
                'recent_invoices' => [],
                'low_stock_items' => [],
            ];
        }
    }

    public function refreshDashboard()
    {
        // Clear cache and reload
        Cache::forget('ahwstore_dashboard_data_' . $this->selectedDateRange);
        Cache::forget('ahwstore_sales_activity');
        Cache::forget('ahwstore_recent_orders');
        Cache::forget('ahwstore_recent_invoices');
        Cache::forget('ahwstore_top_selling_items_' . $this->selectedDateRange);
        Cache::forget('ahwstore_purchase_order_summary_' . $this->selectedDateRange);
        
        $this->loadDashboardData();
        $this->success('Dashboard refreshed successfully!');
    }

    public function updatedPageTitle()
    {
        $this->dispatch('set-page-title', title: $this->pageTitle);
    }
}; ?>

<div wire:init="$dispatch('set-page-title', { title: '{{ $pageTitle }}' })">
    <!-- Header -->
    <x-mary-header title="Dashboard" subtitle="AHW Store Analytics & Overview" separator>
        <x-slot:subtitle>
            <x-mary-breadcrumbs :items="$breadcrumbs" separator="o-slash" separator-class="text-primary"
                class="pt-1 rounded-box" icon-class="text-primary" link-item-class="text-sm font-bold" />
        </x-slot:subtitle>
        <x-slot:middle class="!justify-end">
            <x-mary-button wire:click="refreshDashboard" icon="o-arrow-path" class="btn-sm" 
                :loading="$loading" title="Refresh Dashboard" />
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button icon="o-funnel" class="btn-sm" />
            <x-mary-button icon="o-plus" class="btn-primary btn-sm" />
        </x-slot:actions>
    </x-mary-header>

    <!-- Carousel Section -->
    <div class="relative h-64 overflow-hidden rounded-xl mb-8">
        <x-mary-carousel :slides="$slides" />
    </div>

    <!-- Date Range Filter -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center gap-4">
            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Date Range:</label>
            <x-mary-select wire:model.live="selectedDateRange" :options="$dateRanges" class="w-48" />
        </div>
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Showing data for: <span class="font-medium">{{ $selectedDateRange }}</span>
        </div>
    </div>

    @if($loading)
        <div class="flex items-center justify-center h-64">
            <div class="loading loading-spinner loading-lg text-primary"></div>
        </div>
    @else
        <div class="pb-32">
            <div class="space-y-8">
                <!-- Key Metrics Overview -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <x-mary-stat 
                        title="Total Orders" 
                        :value="$dashboardData['sales_activity']['total_orders'] ?? 0"
                        description="All time" 
                        icon="o-shopping-cart" 
                        color="text-blue-500"
                        class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 border border-blue-200 dark:border-blue-700" 
                    />
                    
                    <x-mary-stat 
                        title="Active Items" 
                        :value="$dashboardData['item_details']['total_items'] ?? 0"
                        description="In inventory" 
                        icon="o-tag" 
                        color="text-green-500"
                        class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 border border-green-200 dark:border-green-700" 
                    />
                    
                    <x-mary-stat 
                        title="Stock Quantity" 
                        :value="number_format($dashboardData['inventory_summary']['quantity_in_hand'] ?? 0)"
                        description="In hand" 
                        icon="o-cube" 
                        color="text-purple-500"
                        class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 border border-purple-200 dark:border-purple-700" 
                    />
                    
                    <x-mary-stat 
                        title="Low Stock Alert" 
                        :value="$dashboardData['inventory_summary']['low_stock_items'] ?? 0"
                        description="Items need reorder" 
                        icon="o-exclamation-triangle" 
                        color="text-red-500"
                        class="bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 border border-red-200 dark:border-red-700" 
                    />
                </div>

                <!-- Sales Pipeline -->
                <div class="card bg-base-100 shadow-xl border border-base-300">
                    <div class="card-body">
                        <div class="flex items-center gap-2 mb-6">
                            <x-mary-icon name="o-chart-pie" class="w-6 h-6 text-primary" />
                            <h2 class="card-title text-xl font-bold">Sales Pipeline</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                            <div class="stat bg-warning/10 rounded-box p-4 border border-warning/20">
                                <div class="stat-figure text-warning">
                                    <x-mary-icon name="o-archive-box" class="w-8 h-8" />
                                </div>
                                <div class="stat-title text-warning-content">To be Packed</div>
                                <div class="stat-value text-warning">{{ $dashboardData['sales_activity']['to_be_packed'] ?? 0 }}</div>
                            </div>
                            
                            <div class="stat bg-orange-500/10 rounded-box p-4 border border-orange-500/20">
                                <div class="stat-figure text-orange-500">
                                    <x-mary-icon name="o-truck" class="w-8 h-8" />
                                </div>
                                <div class="stat-title text-orange-700 dark:text-orange-300">To be Shipped</div>
                                <div class="stat-value text-orange-600 dark:text-orange-400">{{ $dashboardData['sales_activity']['to_be_shipped'] ?? 0 }}</div>
                            </div>
                            
                            <div class="stat bg-success/10 rounded-box p-4 border border-success/20">
                                <div class="stat-figure text-success">
                                    <x-mary-icon name="o-map-pin" class="w-8 h-8" />
                                </div>
                                <div class="stat-title text-success-content">To be Delivered</div>
                                <div class="stat-value text-success">{{ $dashboardData['sales_activity']['to_be_delivered'] ?? 0 }}</div>
                            </div>
                            
                            <div class="stat bg-error/10 rounded-box p-4 border border-error/20">
                                <div class="stat-figure text-error">
                                    <x-mary-icon name="o-document-text" class="w-8 h-8" />
                                </div>
                                <div class="stat-title text-error-content">To be Invoiced</div>
                                <div class="stat-value text-error">{{ $dashboardData['sales_activity']['to_be_invoiced'] ?? 0 }}</div>
                            </div>
                            
                            <div class="stat bg-info/10 rounded-box p-4 border border-info/20">
                                <div class="stat-figure text-info">
                                    <x-mary-icon name="o-arrow-down-tray" class="w-8 h-8" />
                                </div>
                                <div class="stat-title text-info-content">To be Received</div>
                                <div class="stat-value text-info">{{ $dashboardData['inventory_summary']['quantity_to_be_received'] ?? 0 }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Recent Orders -->
                    <div class="card bg-base-100 shadow-xl border border-base-300">
                        <div class="card-body">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-2">
                                    <x-mary-icon name="o-shopping-cart" class="w-6 h-6 text-primary" />
                                    <h2 class="card-title text-xl font-bold">Recent Orders</h2>
                                </div>
                                <x-mary-badge :value="count($dashboardData['recent_orders'])" class="badge-primary" />
                            </div>
                            <div class="space-y-3">
                                @forelse($dashboardData['recent_orders'] as $order)
                                    <div class="flex items-center justify-between p-4 bg-base-200/50 rounded-box hover:bg-base-200 transition-colors">
                                        <div class="flex items-center space-x-3">
                                            <div class="avatar placeholder">
                                                <div class="bg-primary text-primary-content rounded-full w-12">
                                                    <x-mary-icon name="o-shopping-cart" class="w-6 h-6" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-bold text-base-content">{{ $order['number'] }}</div>
                                                <div class="text-sm opacity-70">{{ $order['customer'] }}</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-bold text-base-content">${{ number_format($order['total'], 2) }}</div>
                                            <x-mary-badge :value="$order['status']" class="badge-sm badge-outline" />
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-12">
                                        <x-mary-icon name="o-inbox" class="w-16 h-16 mx-auto mb-4 opacity-50" />
                                        <p class="text-base-content/70">No recent orders</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Recent Invoices -->
                    <div class="card bg-base-100 shadow-xl border border-base-300">
                        <div class="card-body">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-2">
                                    <x-mary-icon name="o-document-text" class="w-6 h-6 text-success" />
                                    <h2 class="card-title text-xl font-bold">Recent Invoices</h2>
                                </div>
                                <x-mary-badge :value="count($dashboardData['recent_invoices'])" class="badge-success" />
                            </div>
                            <div class="space-y-3">
                                @forelse($dashboardData['recent_invoices'] as $invoice)
                                    <div class="flex items-center justify-between p-4 bg-base-200/50 rounded-box hover:bg-base-200 transition-colors">
                                        <div class="flex items-center space-x-3">
                                            <div class="avatar placeholder">
                                                <div class="bg-success text-success-content rounded-full w-12">
                                                    <x-mary-icon name="o-document-text" class="w-6 h-6" />
                                                </div>
                                            </div>
                                            <div>
                                                <div class="font-bold text-base-content">{{ $invoice['number'] }}</div>
                                                <div class="text-sm opacity-70">{{ $invoice['customer'] }}</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-bold text-base-content">${{ number_format($invoice['total'], 2) }}</div>
                                            <x-mary-badge :value="$invoice['status']" class="badge-sm badge-outline" />
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-12">
                                        <x-mary-icon name="o-document-text" class="w-16 h-16 mx-auto mb-4 opacity-50" />
                                        <p class="text-base-content/70">No recent invoices</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Low Stock Items -->
                @if(count($dashboardData['low_stock_items']) > 0)
                <div class="card bg-base-100 shadow-xl border border-base-300">
                    <div class="card-body">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-2">
                                <x-mary-icon name="o-exclamation-triangle" class="w-6 h-6 text-warning" />
                                <h2 class="card-title text-xl font-bold">Low Stock Alerts</h2>
                            </div>
                            <x-mary-badge :value="count($dashboardData['low_stock_items'])" class="badge-warning" />
                        </div>
                        <div class="overflow-x-auto">
                            <table class="table table-zebra w-full">
                                <thead>
                                    <tr>
                                        <th class="text-base-content">Item Name</th>
                                        <th class="text-base-content">Available Stock</th>
                                        <th class="text-base-content">Reorder Level</th>
                                        <th class="text-base-content">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dashboardData['low_stock_items'] as $item)
                                        <tr class="hover">
                                            <td class="font-bold text-base-content">{{ $item['name'] }}</td>
                                            <td>
                                                <span class="text-error font-bold">{{ $item['available_stock'] }}</span>
                                            </td>
                                            <td class="text-base-content">{{ $item['reorder_level'] }}</td>
                                            <td>
                                                <x-mary-badge value="Low Stock" class="badge-sm badge-warning" />
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Top Selling Items and Purchase Order Summary -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Top Selling Items -->
                    <div class="card bg-base-100 shadow-xl border border-base-300">
                        <div class="card-body">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-2">
                                    <x-mary-icon name="o-trophy" class="w-6 h-6 text-warning" />
                                    <h2 class="card-title text-xl font-bold">Top Selling Items</h2>
                                </div>
                                <span class="text-sm opacity-70">{{ $selectedDateRange }}</span>
                            </div>
                            <div class="space-y-3">
                                @forelse($topSellingItems as $index => $item)
                                    <div class="flex items-center justify-between p-4 bg-base-200/50 rounded-box hover:bg-base-200 transition-colors">
                                        <div class="flex items-center space-x-3">
                                            <div class="avatar placeholder">
                                                <div class="bg-warning text-warning-content rounded-full w-10 h-10 text-sm font-bold">
                                                    {{ $index + 1 }}
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="font-bold text-base-content truncate">{{ $item['name'] }}</div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <div class="font-bold text-base-content">{{ $item['quantity'] }} {{ $item['unit'] }}</div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-12">
                                        <x-mary-icon name="o-trophy" class="w-16 h-16 mx-auto mb-4 opacity-50" />
                                        <p class="text-base-content/70">No top selling items</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Purchase Order Summary -->
                    <div class="card bg-base-100 shadow-xl border border-base-300">
                        <div class="card-body">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-2">
                                    <x-mary-icon name="o-shopping-bag" class="w-6 h-6 text-primary" />
                                    <h2 class="card-title text-xl font-bold">Purchase Order</h2>
                                </div>
                                <span class="text-sm opacity-70">{{ $selectedDateRange }}</span>
                            </div>
                            <div class="grid grid-cols-1 gap-4">
                                <div class="stat bg-primary/10 rounded-box p-4 border border-primary/20">
                                    <div class="stat-figure text-primary">
                                        <x-mary-icon name="o-cube" class="w-8 h-8" />
                                    </div>
                                    <div class="stat-title text-primary-content">Quantity Ordered</div>
                                    <div class="stat-value text-primary">{{ number_format($purchaseOrderSummary['quantity_ordered'], 2) }}</div>
                                </div>
                                
                                <div class="stat bg-success/10 rounded-box p-4 border border-success/20">
                                    <div class="stat-figure text-success">
                                        <x-mary-icon name="o-currency-dollar" class="w-8 h-8" />
                                    </div>
                                    <div class="stat-title text-success-content">Total Cost</div>
                                    <div class="stat-value text-success">{{ $purchaseOrderSummary['currency'] }} {{ number_format($purchaseOrderSummary['total_cost'], 2) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     @endif
</div>