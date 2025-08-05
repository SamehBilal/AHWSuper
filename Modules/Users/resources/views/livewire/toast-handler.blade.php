<?php

use function Livewire\Volt\{on};
use Mary\Traits\Toast;

// Use the Toast trait
new class extends \Livewire\Component {
    use Toast;

};

on(['show-toast' => function (...$params) {
   // The data comes as the first parameter when dispatched as an object
    $data = $params ?? [];

    $type = $data[0] ?? 'info';
    $title = $data[1] ?? 'Notification';
    $description = $data[2] ?? '';
    $position = $data[3] ?? 'toast-bottom toast-end';
    $timeout = $data[4] ?? 5000;

    match($type) {
        'success' => $this->success($title, $description, position: $position, timeout: $timeout),
        'error' => $this->error($title, $description, position: $position, timeout: $timeout),
        'warning' => $this->warning($title, $description, position: $position, timeout: $timeout),
        'info' => $this->info($title, $description, position: $position, timeout: $timeout),
        default => $this->info($title, $description, position: $position, timeout: $timeout),
    };
}]);

?>

<div>
    {{-- Toasts --}}
   {{--  <x-mary-toast /> --}}

    {{-- Spotlight --}}
</div>
