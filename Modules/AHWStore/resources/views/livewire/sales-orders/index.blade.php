<?php

use Livewire\Volt\Component;
use Mary\Traits\Toast;
use Livewire\WithPagination;
use Modules\AHWStore\Http\Traits\ZohoApiTrait;

new class extends Component {
    use Toast, ZohoApiTrait;
    use WithPagination;

    public bool $myModal1 = false;
    public $list;
    public $headers;

    public function mount()
    {
        $this->list = collect($this->invoices());
        $this->headers = [
            ['key' => 'salesorder_id', 'label' => 'ID'],
            ['key' => 'salesorder_name', 'label' => 'Name'],
        ];
    }

    public function invoices()
    {
        try {
            $response = $this->zohoRequest('salesorders');
            $data = $response->json();
            return $data['salesorders'] ?? [];
        } catch (Exception $e) {
            return [];
            $this->error('Error', 'Failed to load sales orders: ' . $e->getMessage());
        }
    }
}; ?>



<div>
    <section class="w-full">
        <x-mary-header icon="o-shopping-cart" icon-classes="bg-primary text-white rounded-full p-1 w-6 h-6" title="Sales orders"
            subtitle="List of all the Sales orders" separator progress-indicator="save"
            progress-indicator-class="progress-primary">
            <x-slot:middle class="!justify-end">
                <x-mary-input icon="o-bolt" placeholder="Search..." />
            </x-slot:middle>
            <x-slot:actions>
                <x-mary-button icon="o-funnel" />
                <x-mary-button wire:click="save" icon="o-plus" class="btn-primary" />
            </x-slot:actions>
        </x-mary-header>

        <x-mary-table :headers="$headers" :rows="$list" />
    </section>
</div>
