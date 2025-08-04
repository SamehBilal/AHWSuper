<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;
use Livewire\WithPagination;
use Modules\Store\Http\Traits\ZohoApiTrait;
use Carbon\Carbon;
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
        $this->loadInvoicesData();
        $this->headers = [
            ['key' => 'date', 'label' => 'Date'],
            ['key' => 'invoice_number', 'label' => 'Invoice No'],
            ['key' => 'order_number', 'label' => 'Order Number'],
            ['key' => 'customer_name', 'label' => 'Customer Name'],
            ['key' => 'status', 'label' => 'Status'],
            ['key' => 'due_date', 'label' => 'Due Date'],
            ['key' => 'amount', 'label' => 'Amount', 'class' => 'text-right'],
            ['key' => 'balance_due', 'label' => 'Balance Due', 'class' => 'text-right'],
            ['key' => 'actions', 'label' => 'Actions', 'class' => 'text-center'],
        ];
    }

    public function loadInvoicesData()
    {
        try {
            $this->loading = true;

            // Use cached data if available (cache for 5 minutes)
            $cacheKey = 'store_invoices_data';
            $cachedData = Cache::get($cacheKey);

            if ($cachedData) {
                $this->list = collect($cachedData);
                $this->filteredList = $this->list;
                $this->loading = false;
                return;
            }

            // Fetch fresh data
            $this->list = collect($this->invoices());
            $this->filteredList = $this->list;

            // Cache the results for 5 minutes
            Cache::put($cacheKey, $this->list->toArray(), now()->addMinutes(5));

            $this->loading = false;
        } catch (Exception $e) {
            $this->loading = false;
            $this->error('Error loading invoices data: ' . $e->getMessage());
        }
    }

    public function refreshInvoices()
    {
        // Clear cache and reload
        Cache::forget('store_invoices_data');
        $this->loadInvoicesData();
        $this->success('Invoices refreshed successfully!');
    }

    public function invoices()
    {
        try {
            $response = $this->zohoRequest('invoices');
            $data = $response->json();
            $invoices = $data['invoices'] ?? [];

            // Transform the data to include the new columns
            return collect($invoices)->map(function ($invoice) {
                $date = $invoice['date'] ?? '';
                $invoiceNumber = $invoice['invoice_number'] ?? '-';
                $orderNumber = $invoice['reference_number'] ?? '-';
                $customerName = $invoice['customer_name'] ?? '-';
                $status = $invoice['status'] ?? 'draft';
                $dueDate = $invoice['due_date'] ?? '';
                $amount = $invoice['total'] ?? 0;
                $balanceDue = $invoice['balance'] ?? 0;
                $currencyCode = $invoice['currency_code'] ?? 'USD';
                $invoiceId = $invoice['invoice_id'] ?? '';

                // Format dates
                $formattedDate = $date ? Carbon::parse($date)->format('M d, Y') : '-';
                $formattedDueDate = $dueDate ? Carbon::parse($dueDate)->format('M d, Y') : '-';

                // Format amounts with currency
                $formattedAmount = $currencyCode . ' ' . number_format($amount, 2);
                $formattedBalanceDue = $currencyCode . ' ' . number_format($balanceDue, 2);

                // Format status - capitalize first letter
                $formattedStatus = ucfirst(str_replace('_', ' ', $status));

                return [
                    'invoice_id' => $invoiceId,
                    'date' => $formattedDate,
                    'invoice_number' => $invoiceNumber,
                    'order_number' => $orderNumber,
                    'customer_name' => $customerName,
                    'status' => $formattedStatus,
                    'due_date' => $formattedDueDate,
                    'amount' => $formattedAmount,
                    'balance_due' => $formattedBalanceDue,
                    'currency_code' => $currencyCode,
                    'raw_amount' => $amount,
                    'raw_balance_due' => $balanceDue,
                    'actions' => $invoiceId, // Pass the invoice ID for the buttons
                ];
            })->toArray();
        } catch (Exception $e) {
            return [];
            $this->error('Error', 'Failed to load invoices: ' . $e->getMessage());
        }
    }

    public function updatedSearch()
    {
        if (empty($this->search)) {
            $this->filteredList = $this->list;
            return;
        }

        $this->filteredList = $this->list->filter(function ($invoice) {
            $searchTerm = strtolower($this->search);
            return str_contains(strtolower($invoice['invoice_number']), $searchTerm) ||
                   str_contains(strtolower($invoice['order_number']), $searchTerm) ||
                   str_contains(strtolower($invoice['customer_name']), $searchTerm) ||
                   str_contains(strtolower($invoice['status']), $searchTerm) ||
                   str_contains(strtolower($invoice['invoice_id']), $searchTerm) ||
                   str_contains(strtolower($invoice['date']), $searchTerm) ||
                   str_contains(strtolower($invoice['due_date']), $searchTerm);
        });
    }

    public function viewInvoice($invoiceId)
    {
        // Redirect to view page or open modal
        $this->info('Viewing invoice: ' . $invoiceId, position: 'bottom-right');
        // You can redirect to a view page: return redirect()->route('store.invoices.show', $invoiceId);
    }

    public function editInvoice($invoiceId)
    {
        // Redirect to edit page or open modal
        $this->warning('Editing invoice: ' . $invoiceId, position: 'bottom-right');
        // You can redirect to an edit page: return redirect()->route('store.invoices.edit', $invoiceId);
    }

    public function deleteInvoice($invoiceId)
    {
        // Show confirmation dialog and delete
        $this->error('Deleting invoice: ' . $invoiceId, position: 'bottom-right');
        // You can implement actual deletion logic here
        // After successful deletion, refresh the list
        $this->refreshInvoices();
    }
};

?>

<div>
    <section class="w-full">
        <x-mary-header icon="o-document-currency-dollar" icon-classes="bg-primary text-white rounded-full p-1 w-6 h-6" title="Invoices"
            subtitle="List of all the invoices" separator progress-indicator="save"
            progress-indicator-class="progress-primary">
            <x-slot:middle class="!justify-end">
                <x-mary-input wire:model.live="search" icon="o-magnifying-glass" placeholder="Search invoices..." />
            </x-slot:middle>
            <x-slot:actions>
                <x-mary-button wire:click="refreshInvoices" icon="o-arrow-path" class="btn-sm"
                    :loading="$loading" title="Refresh Invoices" />
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
                                'sent' => 'badge-success',
                                'draft' => 'badge-neutral',
                                'pending' => 'badge-warning',
                                'overdue' => 'badge-error',
                                'paid' => 'badge-info',
                                'cancelled' => 'badge-error',
                                default => 'badge-neutral'
                            };
                        @endphp
                        <x-mary-badge :value="$row['status']" class="{{ $statusClass }} badge-sm" />
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                @endscope

                {{-- Amount column styling with color coding --}}
                @scope('cell_amount', $row)
                    <div class="text-right">
                        <span class="font-medium text-gray-900 dark:text-gray-100">
                            {{ $row['amount'] }}
                        </span>
                    </div>
                @endscope

                {{-- Balance Due column styling with color coding --}}
                @scope('cell_balance_due', $row)
                    @php
                        $balanceDue = $row['raw_balance_due'] ?? 0;
                        $textColor = $balanceDue > 0 ? 'text-error' : 'text-success';
                        $icon = $balanceDue > 0 ? 'o-exclamation-triangle' : 'o-check-circle';
                    @endphp
                    <div class="text-right">
                        <div class="flex items-center justify-end gap-1">
                            <x-mary-icon :name="$icon" class="w-4 h-4 {{ $textColor }}" />
                            <span class="font-medium {{ $textColor }}">
                                {{ $row['balance_due'] }}
                            </span>
                        </div>
                    </div>
                @endscope

                {{-- Actions column styling --}}
                @scope('cell_actions', $row)
                    <div class="flex gap-1 justify-center">
                        <x-mary-button
                            class="btn-sm btn-ghost hover:btn-info"
                            title="View Invoice"
                            wire:click="viewInvoice('{{ $row['invoice_id'] }}')"
                            icon="o-eye"
                        />
                        <x-mary-button
                            class="btn-sm btn-ghost hover:btn-warning"
                            title="Edit Invoice"
                            wire:click="editInvoice('{{ $row['invoice_id'] }}')"
                            icon="o-pencil"
                        />
                        <x-mary-button
                            class="btn-sm btn-ghost hover:btn-error"
                            title="Delete Invoice"
                            wire:click="deleteInvoice('{{ $row['invoice_id'] }}')"
                            icon="o-trash"
                        />
                    </div>
                @endscope
            </x-mary-table>
        @endif
    </section>
</div>
