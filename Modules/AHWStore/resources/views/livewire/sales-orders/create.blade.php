<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;
use Modules\AHWStore\Http\Traits\ZohoApiTrait;
use Carbon\Carbon;

new #[Layout('ahwstore::components.layouts.master')] class extends Component {
    use Toast, ZohoApiTrait;

    // Form fields
    public $customer_id = '';
    public $customer_name = '';
    public $date = '';
    public $shipment_date = '';
    public $delivery_method = '';
    public $reference_number = '';
    public $notes = '';
    public $terms = '';
    public $currency_code = 'USD';
    public $status = 'draft';
    
    // Items array
    public $items = [];
    public $selected_items = [];
    public $available_items = [];
    public $available_customers = [];
    
    // Form validation
    public $isSubmitting = false;

    public function mount()
    {
        $this->date = Carbon::now()->format('Y-m-d');
        $this->shipment_date = Carbon::now()->addDays(7)->format('Y-m-d');
        $this->loadCustomers();
        $this->loadItems();
        $this->addItem();
    }

    public function loadCustomers()
    {
        try {
            $response = $this->zohoRequest('contacts');
            $data = $response->json();
            $this->available_customers = collect($data['contacts'] ?? [])->map(function ($customer) {
                return [
                    'value' => $customer['contact_id'] ?? '',
                    'label' => $customer['contact_name'] ?? '',
                    'email' => $customer['email'] ?? '',
                    'phone' => $customer['phone'] ?? '',
                ];
            })->toArray();
        } catch (Exception $e) {
            $this->error('Error', 'Failed to load customers: ' . $e->getMessage());
        }
    }

    public function loadItems()
    {
        try {
            $response = $this->zohoRequest('items');
            $data = $response->json();
            $this->available_items = collect($data['items'] ?? [])->map(function ($item) {
                return [
                    'value' => $item['item_id'] ?? '',
                    'label' => $item['name'] ?? '',
                    'sku' => $item['sku'] ?? '',
                    'rate' => $item['rate'] ?? 0,
                    'available_stock' => $item['available_stock'] ?? 0,
                ];
            })->toArray();
        } catch (Exception $e) {
            $this->error('Error', 'Failed to load items: ' . $e->getMessage());
        }
    }

    public function addItem()
    {
        $this->items[] = [
            'item_id' => '',
            'name' => '',
            'sku' => '',
            'quantity' => 1,
            'rate' => 0,
            'discount' => 0,
            'tax_percentage' => 0,
            'total' => 0,
        ];
    }

    public function removeItem($index)
    {
        if (count($this->items) > 1) {
            unset($this->items[$index]);
            $this->items = array_values($this->items);
        }
    }

    public function updatedItems($value, $key)
    {
        // Parse the key to get index and field
        $parts = explode('.', $key);
        if (count($parts) === 2) {
            $index = $parts[0];
            $field = $parts[1];
            
            if (isset($this->items[$index])) {
                if ($field === 'item_id' && $value) {
                    // Find the selected item and populate its details
                    $selectedItem = collect($this->available_items)->firstWhere('value', $value);
                    if ($selectedItem) {
                        $this->items[$index]['name'] = $selectedItem['label'];
                        $this->items[$index]['sku'] = $selectedItem['sku'];
                        $this->items[$index]['rate'] = $selectedItem['rate'];
                    }
                }
                
                // Calculate total for this item
                $this->calculateItemTotal($index);
            }
        }
    }

    public function calculateItemTotal($index)
    {
        if (isset($this->items[$index])) {
            $item = $this->items[$index];
            $subtotal = ($item['quantity'] ?? 0) * ($item['rate'] ?? 0);
            $discount = ($subtotal * ($item['discount'] ?? 0)) / 100;
            $taxableAmount = $subtotal - $discount;
            $tax = ($taxableAmount * ($item['tax_percentage'] ?? 0)) / 100;
            $this->items[$index]['total'] = $taxableAmount + $tax;
        }
    }

    public function getSubTotal()
    {
        return collect($this->items)->sum('total');
    }

    public function getTaxTotal()
    {
        return collect($this->items)->sum(function ($item) {
            $subtotal = ($item['quantity'] ?? 0) * ($item['rate'] ?? 0);
            $discount = ($subtotal * ($item['discount'] ?? 0)) / 100;
            $taxableAmount = $subtotal - $discount;
            return ($taxableAmount * ($item['tax_percentage'] ?? 0)) / 100;
        });
    }

    public function getGrandTotal()
    {
        return $this->getSubTotal();
    }

    public function save()
    {
        $this->isSubmitting = true;
        
        // Validate required fields
        if (empty($this->customer_id)) {
            $this->error('Error', 'Please select a customer');
            $this->isSubmitting = false;
            return;
        }

        if (empty($this->date)) {
            $this->error('Error', 'Please select a date');
            $this->isSubmitting = false;
            return;
        }

        // Validate items
        $validItems = collect($this->items)->filter(function ($item) {
            return !empty($item['item_id']) && ($item['quantity'] ?? 0) > 0;
        });

        if ($validItems->isEmpty()) {
            $this->error('Error', 'Please add at least one item');
            $this->isSubmitting = false;
            return;
        }

        try {
            // Prepare the sales order data according to Zoho API structure
            $salesOrderData = [
                'customer_id' => (int) $this->customer_id,
                'date' => $this->date,
                'shipment_date' => $this->shipment_date,
                'delivery_method' => $this->delivery_method,
                'reference_number' => $this->reference_number,
                'notes' => $this->notes,
                'terms' => $this->terms,
                'line_items' => $validItems->map(function ($item) {
                    return [
                        'item_id' => (int) $item['item_id'],
                        'name' => $item['name'],
                        'rate' => (float) $item['rate'],
                        'quantity' => (int) $item['quantity'],
                        'unit' => 'qty',
                        'tax_percentage' => (float) ($item['tax_percentage'] ?? 0),
                        'item_total' => (float) $item['total'],
                    ];
                })->toArray(),
            ];

            // Make API call to create sales order
            $response = $this->zohoRequest('salesorders', 'post', $salesOrderData);
            
            if ($response->successful()) {
                $this->success('Success', 'Sales order created successfully!');
                return redirect()->route('ahwstore.sales-orders.index');
            } else {
                $this->error('Error', 'Failed to create sales order: ' . $response->body());
            }
        } catch (Exception $e) {
            $this->error('Error', 'Failed to create sales order: ' . $e->getMessage());
        }
        
        $this->isSubmitting = false;
    }

    public function cancel()
    {
        return redirect()->route('ahwstore.sales-orders.index');
    }
};

?>

<div>
    <section class="w-full">
        <x-mary-header 
            icon="o-clipboard-document-list" 
            icon-classes="bg-primary text-white rounded-full p-1 w-6 h-6" 
            title="Create Sales Order"
            subtitle="Create a new sales order" 
            separator 
            progress-indicator="save"
            progress-indicator-class="progress-primary">
            <x-slot:actions>
                <x-mary-button 
                    wire:click="cancel" 
                    icon="o-x-mark" 
                    class="btn-ghost" 
                    label="Cancel" />
                <x-mary-button 
                    wire:click="save" 
                    icon="o-check" 
                    class="btn-primary" 
                    label="Save Sales Order"
                    loading="save" />
            </x-slot:actions>
        </x-mary-header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
            <!-- Main Form -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Customer Information -->
                <x-mary-card title="Customer Information" separator>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-mary-select 
                            wire:model.live="customer_id" 
                            :options="$available_customers" 
                            option-value="value" 
                            option-label="label"
                            label="Customer *" 
                            placeholder="Select a customer" />
                        
                        <div class="flex items-end">
                            <x-mary-input 
                                value="{{ $this->customer_id ? collect($available_customers)->firstWhere('value', $this->customer_id)['email'] ?? '-' : '-' }}" 
                                label="Customer Email" 
                                readonly />
                        </div>
                    </div>
                </x-mary-card>

                <!-- Order Details -->
                <x-mary-card title="Order Details" separator>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-mary-input 
                            wire:model="date" 
                            type="date" 
                            label="Order Date *" />
                        
                        <x-mary-input 
                            wire:model="shipment_date" 
                            type="date" 
                            label="Shipment Date" />
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <x-mary-select 
                            wire:model="delivery_method" 
                            :options="[
                                ['value' => 'pickup', 'label' => 'Pickup'],
                                ['value' => 'delivery', 'label' => 'Delivery'],
                                ['value' => 'shipping', 'label' => 'Shipping'],
                                ['value' => 'FedEx', 'label' => 'FedEx'],
                                ['value' => 'UPS', 'label' => 'UPS'],
                                ['value' => 'DHL', 'label' => 'DHL'],
                            ]"
                            option-value="value" 
                            option-label="label"
                            label="Delivery Method" 
                            placeholder="Select delivery method" />
                        
                        <x-mary-input 
                            wire:model="reference_number" 
                            label="Reference Number" 
                            placeholder="Enter reference number" />
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <x-mary-textarea 
                            wire:model="notes" 
                            label="Notes" 
                            placeholder="Enter any additional notes..." 
                            rows="3" />
                        
                        <x-mary-textarea 
                            wire:model="terms" 
                            label="Terms & Conditions" 
                            placeholder="Enter terms and conditions..." 
                            rows="3" />
                    </div>
                </x-mary-card>

                <!-- Items -->
                <x-mary-card title="Order Items" separator>
                    <div class="space-y-4">
                        @foreach($items as $index => $item)
                            <div class="border rounded-lg p-4 bg-gray-50 dark:bg-gray-800">
                                <div class="flex justify-between items-center mb-4">
                                    <h4 class="font-medium">Item {{ $index + 1 }}</h4>
                                    @if(count($items) > 1)
                                        <x-mary-button 
                                            wire:click="removeItem({{ $index }})" 
                                            icon="o-trash" 
                                            class="btn-sm btn-error" />
                                    @endif
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                    <x-mary-select 
                                        wire:model.live="items.{{ $index }}.item_id" 
                                        :options="$available_items" 
                                        option-value="value" 
                                        option-label="label"
                                        label="Item" 
                                        placeholder="Select item" />
                                    
                                    <x-mary-input 
                                        wire:model.live="items.{{ $index }}.quantity" 
                                        type="number" 
                                        min="1"
                                        label="Quantity" />
                                    
                                    <x-mary-input 
                                        wire:model.live="items.{{ $index }}.rate" 
                                        type="number" 
                                        step="0.01"
                                        min="0"
                                        label="Rate" />
                                    
                                    <x-mary-input 
                                        wire:model.live="items.{{ $index }}.discount" 
                                        type="number" 
                                        step="0.01"
                                        min="0"
                                        max="100"
                                        label="Discount %" />
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                    <x-mary-input 
                                        wire:model.live="items.{{ $index }}.tax_percentage" 
                                        type="number" 
                                        step="0.01"
                                        min="0"
                                        max="100"
                                        label="Tax %" />
                                    
                                    <div class="flex items-end">
                                        <x-mary-input 
                                            value="{{ number_format($item['total'] ?? 0, 2) }}" 
                                            label="Total" 
                                            readonly />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="flex justify-center">
                            <x-mary-button 
                                wire:click="addItem" 
                                icon="o-plus" 
                                class="btn-outline" 
                                label="Add Item" />
                        </div>
                    </div>
                </x-mary-card>
            </div>

            <!-- Summary Sidebar -->
            <div class="space-y-6">
                <!-- Order Summary -->
                <x-mary-card title="Order Summary" separator>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Subtotal:</span>
                            <span class="font-medium">{{ $currency_code }} {{ number_format($this->getSubTotal(), 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600 dark:text-gray-400">Tax:</span>
                            <span class="font-medium">{{ $currency_code }} {{ number_format($this->getTaxTotal(), 2) }}</span>
                        </div>
                        {{-- <x-mary-separator /> --}}
                        <div class="divider"></div>
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total:</span>
                            <span>{{ $currency_code }} {{ number_format($this->getGrandTotal(), 2) }}</span>
                        </div>
                    </div>
                </x-mary-card>

                <!-- Order Settings -->
                <x-mary-card title="Order Settings" separator>
                    <div class="space-y-4">
                        <x-mary-select 
                            wire:model="currency_code" 
                            :options="[
                                ['value' => 'USD', 'label' => 'USD - US Dollar'],
                                ['value' => 'EUR', 'label' => 'EUR - Euro'],
                                ['value' => 'GBP', 'label' => 'GBP - British Pound'],
                            ]"
                            option-value="value" 
                            option-label="label"
                            label="Currency" />
                        
                        <x-mary-select 
                            wire:model="status" 
                            :options="[
                                ['value' => 'draft', 'label' => 'Draft'],
                                ['value' => 'confirmed', 'label' => 'Confirmed'],
                                ['value' => 'pending', 'label' => 'Pending'],
                            ]"
                            option-value="value" 
                            option-label="label"
                            label="Status" />
                    </div>
                </x-mary-card>
            </div>
        </div>
    </section>
</div>