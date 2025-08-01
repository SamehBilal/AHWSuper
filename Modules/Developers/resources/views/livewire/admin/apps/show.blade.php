<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;
use Modules\Developers\Models\App;
use Modules\Developers\Services\AppService as DeveloperAppService;

new #[Layout('developers::components.layouts.admin')] class extends Component {
    use Toast;

    public App $app;
    public string $period = '30d';
    public array $analytics = [];

    public function mount(App $app)
    {
        $this->app = $app;
        $this->loadAnalytics();
    }

    public function updatedPeriod()
    {
        $this->loadAnalytics();
    }

    public function loadAnalytics()
    {
        $service = new DeveloperAppService();
        $this->analytics = $service->getAppAnalytics($this->app, $this->period);
    }
}; ?>
