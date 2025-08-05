<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;
use Modules\Store\Http\Traits\ZohoApiTrait;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

new #[Layout('store::components.layouts.admin', ['pageTitle' => 'Arabhardware | App Testers'])] class extends Component {
    use Toast, ZohoApiTrait;

    public $dashboardData = [];
    public $loading = true;
    public $breadcrumbs;
    public $selectedDateRange = 'This Month';
    public $topSellingItems = [];
    public $purchaseOrderSummary = [];
    public $slides;
    public $message;
    public $author;

    public $dateRanges = [['id' => 'Today', 'name' => 'Today'], ['id' => 'Yesterday', 'name' => 'Yesterday'], ['id' => 'This Week', 'name' => 'This Week'], ['id' => 'This Month', 'name' => 'This Month'], ['id' => 'This Year', 'name' => 'This Year'], ['id' => 'Previous Week', 'name' => 'Previous Week'], ['id' => 'Previous Month', 'name' => 'Previous Month'], ['id' => 'Previous Year', 'name' => 'Previous Year'], ['id' => 'Custom', 'name' => 'Custom']];

    public function mount()
    {
        [$this->message, $this->author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
        $this->breadcrumbs = [
            [
                'label' => 'Home',
                'link' => route('dashboard'),
            ],
            [
                'label' => 'Dashboard',
            ],
        ];

        $this->slides = [
            [
                'image' => asset('store.webp'),
                'title' => 'AHW Store first',
                'description' => 'We love last week frameworks.',
                'url' => '/#',
                'urlText' => 'Get started',
            ],
            /* [
                'image' => asset('store1.webp'),
                'title' => 'Ahw Store second',
                'description' => 'Where burnout is just a fancy term for Tuesday.',
            ], */
            [
                'image' => asset('store2.webp'),
                'title' => 'Ahw Store third',
                'description' => 'Where burnout is just a fancy term for Tuesday.',
            ],
            [
                'image' => asset('store3.webp'),
                'title' => 'Ahw Store fourth',
                'description' => 'Where burnout is just a fancy term for Tuesday.',
            ],
            [
                'image' => asset('store4.webp'),
                'title' => 'Ahw Store fifth',
                'description' => 'Where burnout is just a fancy term for Tuesday.',
            ],
            [
                'image' => asset('store5.webp'),
                'title' => 'Ahw Store sixth',
                'description' => 'Where burnout is just a fancy term for Tuesday.',
            ],
            [
                'image' => asset('store6.webp'),
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

        return match ($range) {
            'Today' => [
                'start' => $now->copy()->startOfDay(),
                'end' => $now->copy()->endOfDay(),
            ],
            'Yesterday' => [
                'start' => $now->copy()->subDay()->startOfDay(),
                'end' => $now->copy()->subDay()->endOfDay(),
            ],
            'This Week' => [
                'start' => $now->copy()->startOfWeek()->startOfDay(),
                'end' => $now->copy()->endOfWeek()->endOfDay(),
            ],
            'This Month' => [
                'start' => $now->copy()->startOfMonth()->startOfDay(),
                'end' => $now->copy()->endOfMonth()->endOfDay(),
            ],
            'This Year' => [
                'start' => $now->copy()->startOfYear()->startOfDay(),
                'end' => $now->copy()->endOfYear()->endOfDay(),
            ],
            'Previous Week' => [
                'start' => $now->copy()->subWeek()->startOfWeek()->startOfDay(),
                'end' => $now->copy()->subWeek()->endOfWeek()->endOfDay(),
            ],
            'Previous Month' => [
                'start' => $now->copy()->subMonth()->startOfMonth()->startOfDay(),
                'end' => $now->copy()->subMonth()->endOfMonth()->endOfDay(),
            ],
            'Previous Year' => [
                'start' => $now->copy()->subYear()->startOfYear()->startOfDay(),
                'end' => $now->copy()->subYear()->endOfYear()->endOfDay(),
            ],
            default => [
                'start' => $now->copy()->startOfMonth()->startOfDay(),
                'end' => $now->copy()->endOfMonth()->endOfDay(),
            ],
        };
    }

    public function loadDashboardData()
    {
        try {
            $this->loading = true;

            // Use cached data if available (cache for 5 minutes)
            $cacheKey = 'store_dashboard_data_' . $this->selectedDateRange;
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
            $cacheKey = 'store_top_selling_items_' . $this->selectedDateRange;
            $cachedData = Cache::get($cacheKey);

            if ($cachedData) {
                $this->topSellingItems = $cachedData;
                return;
            }

            // Fetch all sales orders to analyze top selling items
            $orders = $this->fetchAllZohoPages('salesorders', 'salesorders');

            // Debug: Log first 3 sales orders and all unique statuses
            \Log::info('TopSellingItems Debug: First 3 Orders', array_slice($orders, 0, 3));
            \Log::info('TopSellingItems Debug: Unique Order Statuses', collect($orders)->pluck('status')->unique()->values()->all());

            // Get date range for filtering
            $dateRange = $this->getDateRangeDates($this->selectedDateRange);
            $startDate = $dateRange['start'];
            $endDate = $dateRange['end'];
            \Log::info('TopSellingItems Debug: Date Range', ['start' => $startDate, 'end' => $endDate]);

            // Filter orders by date range
            $filteredOrders = collect($orders)->filter(function ($order) use ($startDate, $endDate) {
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
                                'unit' => $unit,
                            ];
                        }
                        $itemSales[$itemName]['quantity'] += $quantity;
                    }
                }
            }

            // Sort by quantity and take top 6
            $this->topSellingItems = collect($itemSales)->sortByDesc('quantity')->take(6)->values()->toArray();

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
            $cacheKey = 'store_purchase_order_summary_' . $this->selectedDateRange;
            $cachedData = Cache::get($cacheKey);

            if ($cachedData) {
                $this->purchaseOrderSummary = $cachedData;
                return;
            }

            // Fetch all purchase orders
            $purchaseOrders = $this->fetchAllZohoPages('purchaseorders', 'purchaseorders');

            // Debug: Log first 3 purchase orders and all unique statuses
            \Log::info('PurchaseOrderSummary Debug: First 3 Purchase Orders', array_slice($purchaseOrders, 0, 3));
            \Log::info('PurchaseOrderSummary Debug: Unique PO Statuses', collect($purchaseOrders)->pluck('status')->unique()->values()->all());

            // Get date range for filtering
            $dateRange = $this->getDateRangeDates($this->selectedDateRange);
            $startDate = $dateRange['start'];
            $endDate = $dateRange['end'];
            \Log::info('PurchaseOrderSummary Debug: Date Range', ['start' => $startDate, 'end' => $endDate]);

            // Filter purchase orders by date range
            $filteredPurchaseOrders = collect($purchaseOrders)->filter(function ($po) use ($startDate, $endDate) {
                $poDate = Carbon::parse($po['date'] ?? '');
                return $poDate->between($startDate, $endDate);
            });

            // Calculate summary
            $totalQuantity = 0;
            $totalCost = 0;
            $currency = 'EGP'; // Default currency

            foreach ($filteredPurchaseOrders as $po) {
                $lineItems = $po['line_items'] ?? [];
                foreach ($lineItems as $lineItem) {
                    $quantity = $lineItem['quantity'] ?? 0;
                    $rate = $lineItem['rate'] ?? 0;

                    $totalQuantity += $quantity;
                    $totalCost += $quantity * $rate;
                }

                // Get currency from first PO
                if (empty($currency) && isset($po['currency_code'])) {
                    $currency = $po['currency_code'];
                }
            }

            $this->purchaseOrderSummary = [
                'quantity_ordered' => round($totalQuantity, 2),
                'total_cost' => round($totalCost, 2),
                'currency' => $currency,
            ];

            // Cache the results
            Cache::put($cacheKey, $this->purchaseOrderSummary, now()->addMinutes(5));
        } catch (Exception $e) {
            \Log::error('Error loading purchase order summary: ' . $e->getMessage());
            $this->purchaseOrderSummary = [
                'quantity_ordered' => 0,
                'total_cost' => 0,
                'currency' => 'EGP',
            ];
        }
    }

    public function fetchAllDataInParallel()
    {
        try {
            // Fetch all items, sales orders, and invoices (all pages)
            $items = $this->fetchAllZohoPages('items', 'items');
            $orders = $this->fetchAllZohoPages('salesorders', 'salesorders');
            $invoices = $this->fetchAllZohoPages('invoices', 'invoices');

            // Debug: Log first 3 items/orders/invoices and all unique statuses
            \Log::info('Dashboard Debug: First 3 Items', array_slice($items, 0, 3));
            \Log::info('Dashboard Debug: First 3 Orders', array_slice($orders, 0, 3));
            \Log::info('Dashboard Debug: First 3 Invoices', array_slice($invoices, 0, 3));
            \Log::info('Dashboard Debug: Unique Order Statuses', collect($orders)->pluck('status')->unique()->values()->all());
            \Log::info('Dashboard Debug: Unique Invoice Statuses', collect($invoices)->pluck('status')->unique()->values()->all());
            \Log::info('Dashboard Debug: Unique Item Statuses', collect($items)->pluck('status')->unique()->values()->all());

            // Calculate all metrics from real data
            $totalItems = count($items);
            $totalQuantity = collect($items)->sum('available_stock');
            $activeItems = collect($items)->filter(fn($item) => ($item['status'] ?? '') === 'active')->count();
            $activePercentage = $totalItems > 0 ? round(($activeItems / $totalItems) * 100, 1) : 0;

            $lowStockItems = collect($items)
                ->filter(function ($item) {
                    $availableStock = $item['available_stock'] ?? 0;
                    $reorderLevel = $item['reorder_level'] ?? 0;
                    return $availableStock <= $reorderLevel && $availableStock > 0;
                })
                ->take(5)
                ->map(function ($item) {
                    return [
                        'id' => $item['item_id'] ?? '',
                        'name' => $item['name'] ?? '',
                        'available_stock' => $item['available_stock'] ?? 0,
                        'reorder_level' => $item['reorder_level'] ?? 0,
                    ];
                })
                ->toArray();

            // Calculate sales activity from real data
            $totalOrders = count($orders);
            // To be Packed: status === 'confirmed'
            $toBePacked = collect($orders)
                ->filter(function ($order) {
                    return ($order['status'] ?? '') === 'confirmed';
                })
                ->count();
            // To be Shipped: status === 'fulfilled'
            $toBeShipped = collect($orders)
                ->filter(function ($order) {
                    return ($order['status'] ?? '') === 'fulfilled';
                })
                ->count();
            // To be Delivered: status === 'shipped'
            $toBeDelivered = collect($orders)
                ->filter(function ($order) {
                    return ($order['status'] ?? '') === 'shipped';
                })
                ->count();
            // To be Invoiced: status === 'draft'
            $toBeInvoiced = collect($orders)
                ->filter(function ($order) {
                    return ($order['status'] ?? '') === 'draft';
                })
                ->count();

            $salesActivity = [
                'total_orders' => $totalOrders,
                'to_be_packed' => $toBePacked,
                'to_be_shipped' => $toBeShipped,
                'to_be_delivered' => $toBeDelivered,
                'to_be_invoiced' => $toBeInvoiced,
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
                ->map(function ($order) {
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
                ->map(function ($invoice) {
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
            Cache::put('store_sales_activity', $salesActivity, now()->addMinutes(5));
            Cache::put('store_recent_orders', $recentOrders, now()->addMinutes(5));
            Cache::put('store_recent_invoices', $recentInvoices, now()->addMinutes(5));

            return $finalData;
        } catch (Exception $e) {
            \Log::error('Dashboard Data Fetch Error:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
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
        Cache::forget('store_dashboard_data_' . $this->selectedDateRange);
        Cache::forget('store_sales_activity');
        Cache::forget('store_recent_orders');
        Cache::forget('store_recent_invoices');
        Cache::forget('store_top_selling_items_' . $this->selectedDateRange);
        Cache::forget('store_purchase_order_summary_' . $this->selectedDateRange);

        $this->loadDashboardData();
        $this->success('Dashboard refreshed successfully!');
    }
}; ?>

<div>

    <!-- Header -->
    <x-mary-header title="Dashboard" subtitle="AHW Store Analytics & Overview" separator>
        <x-slot:subtitle>
            <x-mary-breadcrumbs :items="$breadcrumbs" separator="o-slash" separator-class="text-primary"
                class="pt-1 rounded-box" icon-class="text-primary" link-item-class="text-sm font-bold" />
        </x-slot:subtitle>
        <x-slot:middle class="!justify-end">
            <x-mary-button wire:click="refreshDashboard" icon="o-arrow-path" class="btn-sm !w-10 !rounded-lg" :loading="$loading"
                title="Refresh Dashboard" />
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button link="{{ route('store.sales-orders.create') }}"
                route="{{ route('store.sales-orders.create') }}" icon="o-plus" class="btn-primary btn-sm !w-10 !rounded-lg" />
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

    <div class="grid grid-cols-4 gap-x-8 gap-y-4">
        <!-- Key Metrics Overview -->
        <x-mary-stat title="Total Orders" :value="$dashboardData['sales_activity']['total_orders'] ?? 0" description="All time" icon="o-shopping-cart"
            class="shadow border" />

        <x-mary-stat title="Active Items" :value="$dashboardData['item_details']['total_items'] ?? 0" description="In inventory" icon="o-tag"
            class="shadow border" />

        <x-mary-stat title="Stock Quantity" :value="number_format($dashboardData['inventory_summary']['quantity_in_hand'] ?? 0)" description="In hand" class="shadow border"
            icon="o-cube" />

        <x-mary-stat title="Low Stock Alert" :value="$dashboardData['inventory_summary']['low_stock_items'] ?? 0" description="Items need reorder"
            icon="o-exclamation-triangle" class="shadow border" />
    </div>


    <!-- Sales Pipeline -->
    <div class="grid grid-cols-8 gap-x-8 gap-y-4 mt-5">


        <div class="col-span-3">
            <ul class="list bg-base-100 rounded-box shadow-md">

                <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Recent Orders</li>

                @forelse($dashboardData['recent_orders'] as $index => $order)
                    <li class="list-row">
                        <div class="text-4xl font-thin opacity-30 tabular-nums">0{{ $index + 1 }}</div>
                        <div>
                            <div class="flex items-center justify-center">
                                <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                                    <x-mary-icon name="o-shopping-cart" class="w-6 h-6 text-white" />
                                </div>
                            </div>

                        </div>
                        <div class="list-col-grow">
                            <div>{{ $order['number'] }}</div>
                            <div class="text-xs uppercase font-semibold opacity-60">{{ $order['customer'] }}</div>

                        </div>
                        <button class="btn w-full btn-square btn-ghost p-1">
                            {{ $order['status'] }}
                        </button>

                        <button class="btn w-full btn-square btn-ghost p-1">
                            EGP {{ number_format($order['total'], 2) }}
                        </button>
                    </li>
                @empty
                    <li class="list-row">
                        <div class="list-col-grow">
                            <div>No recent orders</div>
                        </div>
                    </li>
                @endforelse

            </ul>
        </div>

        <div class="col-span-3">
            <ul class="list bg-base-100 rounded-box shadow-md">

                <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Recent Invoices</li>

                @forelse($dashboardData['recent_invoices'] as $index => $invoice)
                    <li class="list-row">
                        <div class="text-4xl font-thin opacity-30 tabular-nums">0{{ $index + 1 }}</div>
                        <div>
                            <div class="flex items-center justify-center">
                                <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                                    <x-mary-icon name="o-document-currency-dollar" class="w-6 h-6 text-white" />
                                </div>
                            </div>

                        </div>
                        <div class="list-col-grow">
                            <div>{{ $invoice['number'] }}</div>
                            <div class="text-xs uppercase font-semibold opacity-60">{{ $invoice['customer'] }}</div>

                        </div>
                        <button class="btn w-full btn-square btn-ghost p-1">
                            {{ $invoice['status'] }}
                        </button>

                        <button class="btn w-full btn-square btn-ghost p-1">
                            EGP {{ number_format($invoice['total'], 2) }}
                        </button>
                    </li>
                @empty
                    <li class="list-row">
                        <div class="list-col-grow">
                            <div>No recent invoices</div>
                        </div>
                    </li>
                @endforelse

            </ul>
        </div>

        <x-mary-card class="col-span-2 bg-primary text-neutral-content  items-center text-center" title="Tip of today!">
            <p>{{ trim($message) }}</p>
            <p>{{ trim($author) }}</p>

            <div class="absolute bottom-5 right-5 text-neutral-content">
                <x-mary-icon name="o-trophy" class="w-20 h-20  opacity-20" />
            </div>
        </x-mary-card>

        <div class="col-span-8 relative overflow-hidden ">
            <div class="stats bg-base-100 border-base-300 border w-full shadow">
                <div class="stat">
                    <div class="stat-figure text-primary">
                        <x-mary-icon name="o-archive-box" class="w-8 h-8" />
                    </div>
                    <div class="stat-title">To be Packed</div>
                    <div class="stat-value">{{ $dashboardData['sales_activity']['to_be_packed'] ?? 0 }}</div>
                    <div class="stat-desc">21% more than last month</div>
                    {{-- <div class="stat-actions">
                        <button class="btn btn-xs btn-success">Add funds</button>
                    </div> --}}
                </div>
                <div class="stat">
                    <div class="stat-figure text-primary">
                        <x-mary-icon name="o-truck" class="w-8 h-8" />
                    </div>
                    <div class="stat-title">To be Shipped</div>
                    <div class="stat-value"> {{ $dashboardData['sales_activity']['to_be_shipped'] ?? 0 }}</div>
                    <div class="stat-desc">↗︎ 400 (22%)</div>
                    {{-- <div class="stat-actions">
                        <button class="btn btn-xs btn-success">Add funds</button>
                    </div> --}}
                </div>

                <div class="stat">
                    <div class="stat-figure text-primary">
                        <div class="w-16 rounded-full">
                            <x-mary-icon name="o-map-pin" class="w-8 h-8" />
                        </div>
                    </div>
                    <div class="stat-title">To be Delivered</div>
                    <div class="stat-value">{{ $dashboardData['sales_activity']['to_be_delivered'] ?? 0 }}</div>
                    <div class="stat-desc">↘︎ 90 (14%)</div>
                    {{--  <div class="stat-actions">
                        <button class="btn btn-xs">Withdrawal</button>
                        <button class="btn btn-xs">Deposit</button>
                    </div> --}}
                </div>

                <div class="stat">
                    <div class="stat-figure text-primary">
                        <x-mary-icon name="o-document-text" class="w-8 h-8" />
                    </div>
                    <div class="stat-title">To be Invoiced</div>
                    <div class="stat-value">{{ $dashboardData['sales_activity']['to_be_invoiced'] ?? 0 }}</div>
                    <div class="stat-desc">21% more than last month</div>
                    {{-- <div class="stat-actions">
                        <button class="btn btn-xs btn-success">Add funds</button>
                    </div> --}}
                </div>

                <div class="stat">
                    <div class="stat-figure text-primary">
                        <div class="w-16 rounded-full">
                            <x-mary-icon name="o-arrow-down-tray" class="w-8 h-8" />
                        </div>
                    </div>
                    <div class="stat-title">To be Received</div>
                    <div class="stat-value"> {{ $dashboardData['inventory_summary']['quantity_to_be_received'] ?? 0 }}
                    </div>
                    <div class="stat-desc">Jan 1st - Feb 1st</div>
                    {{-- <div class="stat-actions">
                        <button class="btn btn-xs">Withdrawal</button>
                        <button class="btn btn-xs">Deposit</button>
                    </div> --}}
                </div>
            </div>
        </div>

        <!-- Purchase Order Summary -->
        <div class="col-span-2 card bg-base-100 shadow-xl border border-base-300">
            <div class="card-body">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-2">
                        <x-mary-icon name="o-shopping-bag" class="w-6 h-6 text-primary" />
                        <h2 class="card-title text-xl font-bold">Purchase Order</h2>
                    </div>
                    <span class="text-sm opacity-70">{{ $selectedDateRange }}</span>
                </div>
                <div class="grid grid-cols-1 gap-4">
                    <div class="stat rounded-box p-4 border">
                        <div class="stat-figure text-primary">
                            <x-mary-icon name="o-cube" class="w-8 h-8" />
                        </div>
                        <div class="stat-title text-success-content">Quantity Ordered</div>
                        <div class="stat-value text-primary">
                            {{ number_format($purchaseOrderSummary['quantity_ordered'], 2) }}</div>
                    </div>

                    <div class="stat rounded-box p-4 border">
                        <div class="stat-figure text-success">
                            <x-mary-icon name="o-currency-dollar" class="w-8 h-8" />
                        </div>
                        <div class="stat-title text-success-content">Total Cost</div>
                        <div class="stat-value text-success">{{ $purchaseOrderSummary['currency'] }}
                            {{ number_format($purchaseOrderSummary['total_cost'], 2) }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-span-4 card bg-base-100 shadow-xl border border-base-300">
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
                        <div
                            class="flex items-center justify-between p-4 bg-base-200/50 rounded-box hover:bg-base-200 transition-colors">
                            <div class="flex items-center space-x-3">
                                <div class="avatar placeholder">
                                    <div
                                        class="bg-warning text-warning-content rounded-full w-10 h-10 text-sm font-bold">
                                        {{ $index + 1 }}
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="font-bold text-base-content truncate">{{ $item['name'] }}
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-base-content">{{ $item['quantity'] }}
                                    {{ $item['unit'] }}</div>
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

        {{-- <div class="col-span-2">
            <calendar-date class="cally border   shadow-lg rounded-box">
                <svg aria-label="Previous" class="fill-current size-4" slot="previous"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M15.75 19.5 8.25 12l7.5-7.5"></path>
                </svg>
                <svg aria-label="Next" class="fill-current size-4" slot="next" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24">
                    <path fill="currentColor" d="m8.25 4.5 7.5 7.5-7.5 7.5"></path>
                </svg>
                <calendar-month></calendar-month>
            </calendar-date>
        </div> --}}


        <!-- Low Stock Items -->
        @if (count($dashboardData['low_stock_items']) > 0)
            <div class="col-span-2 card bg-base-100 shadow-xl border border-base-300">
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
                                @foreach ($dashboardData['low_stock_items'] as $item)
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

    </div>


    @if ($loading)
        <div class="flex items-center justify-center h-64">
            <div class="loading loading-spinner loading-lg text-primary"></div>
        </div>
    @else
        <div class="pb-32">
            <div class="space-y-8">


            </div>
        </div>
    @endif
</div>
