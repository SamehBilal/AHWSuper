<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;

new #[Layout('developers::components.layouts.admin')] class extends Component {
    use Toast;

    public $pageTitle = 'Arabhardware | Developers';
}; ?>

<div>hi</div>

