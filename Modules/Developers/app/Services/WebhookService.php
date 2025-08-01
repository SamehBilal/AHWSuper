<?php

namespace Modules\Developers\Services;

use App\Models\User;
use Modules\Developers\Models\Webhook;
use Modules\Developers\Models\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebhookService
{
    public function triggerWebhook(App $app, string $event, array $data): void
    {
        $webhooks = $app->webhooks()
            ->where('is_active', true)
            ->whereJsonContains('events', $event)
            ->get();

        foreach ($webhooks as $webhook) {
            $this->sendWebhook($webhook, $event, $data);
        }
    }

    protected function sendWebhook(Webhook $webhook, string $event, array $data): void
    {
        $payload = [
            'event' => $event,
            'timestamp' => now()->toISOString(),
            'data' => $data,
            'app_id' => $webhook->app_id,
        ];

        $signature = hash_hmac('sha256', json_encode($payload), $webhook->secret);

        try {
            $response = Http::timeout(30)
                ->withHeaders([
                    'User-Agent' => 'ArabHardware-Webhook/1.0',
                    'X-AH-Signature' => 'sha256=' . $signature,
                    'X-AH-Event' => $event,
                ])
                ->post($webhook->url, $payload);

            $webhook->update(['last_triggered_at' => now()]);

            if (!$response->successful()) {
                Log::warning("Webhook failed for app {$webhook->app_id}", [
                    'webhook_id' => $webhook->id,
                    'status' => $response->status(),
                    'response' => $response->body(),
                ]);
            }

        } catch (\Exception $e) {
            Log::error("Webhook error for app {$webhook->app_id}", [
                'webhook_id' => $webhook->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
