<x-layouts.app :title="__('Arabhardware | Dashboard')">

    <!-- Dashboard Cards -->
    <div class="grid grid-cols-8 gap-x-8 gap-y-4 mt-5 min-h-[300px]">
        <div class="col-span-6">
            <livewire:partials.admin.widgets.welcome-back-card />
        </div>
        <div class="col-span-2 row-span-2">
            <x-calendar />
        </div>
    </div>

</x-layouts.app>
