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
        $this->list = collect($this->items());
        $this->headers = [
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'sku', 'label' => 'SKU'],
            ['key' => 'status', 'label' => 'Status'],
        ];
    }

    public function items()
    {
        try {
            $response = $this->zohoRequest('items');
            $data = $response->json();
            return $data['items'] ?? [];
        } catch (Exception $e) {
            return [];
            $this->error('Error', 'Failed to load items: ' . $e->getMessage());
        }
    }
}; ?>



<div>
    <section class="w-full">
        <x-mary-header icon="o-shopping-cart" icon-classes="bg-primary text-white rounded-full p-1 w-6 h-6" title="Items"
            subtitle="List of all the items" separator progress-indicator="save"
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
