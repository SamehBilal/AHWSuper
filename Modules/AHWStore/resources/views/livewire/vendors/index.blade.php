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
        $this->list = collect($this->vendors());
        $this->headers = [
            ['key' => 'vendor_id', 'label' => 'ID'],
            ['key' => 'vendor_name', 'label' => 'Name'],
        ];
    }

    public function vendors()
    {
        try {
            $response = $this->zohoRequest('vendors');
            $data = $response->json();
            return $data['vendors'] ?? [];
        } catch (Exception $e) {
            return [];
            $this->error('Error', 'Failed to load vendors: ' . $e->getMessage());
        }
    }
}; ?>



<div>
    <section class="w-full">
        <x-mary-header icon="o-shopping-cart" icon-classes="bg-primary text-white rounded-full p-1 w-6 h-6" title="Vendors"
            subtitle="List of all the vendors" separator progress-indicator="save"
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
