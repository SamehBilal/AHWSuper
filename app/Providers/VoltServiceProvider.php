<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Volt\Volt;
use Nwidart\Modules\Facades\Module;

class VoltServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
         $mountPaths = [
            config('livewire.view_path', resource_path('views/livewire')),
            resource_path('views/pages'),
        ];

        // Add all enabled module paths
        foreach (Module::allEnabled() as $module) {
            $moduleLivewirePath = $module->getPath() . '/Resources/views/livewire';
            if (is_dir($moduleLivewirePath)) {
                $mountPaths[] = $moduleLivewirePath;
            }
        }

        Volt::mount($mountPaths);
    }
}
