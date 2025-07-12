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
        $this->list = collect($this->contacts());
        $this->headers = [
            ['key' => 'contact_id', 'label' => 'ID'],
            ['key' => 'contact_name', 'label' => 'Name'],
        ];
    }

    public function contacts()
    {
        try {
            $response = $this->zohoRequest('contacts');
            $data = $response->json();
            return $data['contacts'] ?? [];
        } catch (Exception $e) {
            return [];
            $this->error('Error', 'Failed to load customers: ' . $e->getMessage());
        }
    }
}; ?>

<x-ahwstore::layouts.master>
    <div>
        <section class="w-full">
            <x-mary-header icon="o-shopping-cart" icon-classes="bg-primary text-white rounded-full p-1 w-6 h-6" title="Customers"
                subtitle="List of all the contacts" separator progress-indicator="save"
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
</x-ahwstore::layouts.master>
