<?php

namespace Modules\AHWStore\Http\Traits;

use Illuminate\Support\Facades\Http;
use Modules\AHWStore\Models\APIToken;

trait ZohoApiTrait
{
    protected function getZohoSettings()
    {
        // You may want to cache this for performance
        /* APIToken::create([
            'provider' => 'zoho',
            'access_token' => "1000.45864334a53f33b50b4dd38a0e4f6c77.612bdebad967b0f322a74ae51a63f7c2",
            'refresh_token' => "1000.54cfd932bfbcd3f04a766cac5d5cbf7b.4adb24c10b724f8351f679f172ae5ecf",
            'client_id' => '1000.GTDDX00LS0Q7U9XEX2IVM1KESLWVLI',
            'client_secret' => 'e1945c2ffd9b07fc412041ad3ed8126188cbfb0372',
            'redirect_url' => 'http://127.0.0.1:8000/auth/zoho/callback',
            'base_url' => "https://www.zohoapis.com/inventory/v1/",
            'organization_id' => "889324195",
        ]); */

        /* https://accounts.zoho.com/oauth/v2/auth?
                scope=ZohoInventory.fullaccess.all&
                client_id=1000.GTDDX00LS0Q7U9XEX2IVM1KESLWVLI&
                response_type=code&access_type=offline&prompt=consent&
                redirect_uri=http://127.0.0.1:8000/auth/zoho/callback */
        $settings = APIToken::where('provider', 'zoho')->first();
         /* dd($settings); */
        if (!$settings) {
            // Handle the case where settings are not found
            return response()->json(['error' => 'Zoho settings not found'], 404);
        }
        return $settings;
    }

    protected function zohoRequest($endpoint, $method = 'get', $options = [])
    {
        $settings = $this->getZohoSettings();
        $url = "{$settings->base_url}{$endpoint}?organization_id={$settings->organization_id}";

        //dd($url);

        $response = Http::withToken($settings->access_token)->$method($url, $options);


        // If unauthorized, handle token refresh here if needed
        if ($response->status() === 401) {
            $refreshResponse = Http::asForm()->post('https://accounts.zoho.com/oauth/v2/token', [
                'refresh_token' => $settings->refresh_token,
                'client_id' => $settings->client_id,
                'client_secret' => $settings->client_secret,
                'redirect_uri' => $settings->redirect_url,
                'grant_type' => 'refresh_token',
            ]);

            if ($refreshResponse->successful() && isset($refreshResponse['access_token'])) {
                $newToken = $refreshResponse['access_token'];
                $settings->update(['access_token' => $newToken]);
                $response = Http::withToken($newToken)->$method($url, $options);

            } else {
                return response()->json(['error' => 'Failed to refresh token'], 401);
            }

        }
        //dd($response->json());

        return $response;
    }

    /**
     * Fetch all pages of a Zoho API resource and merge the results.
     * @param string $endpoint
     * @param string $dataKey The key in the response containing the data array (e.g. 'items', 'salesorders')
     * @param array $options Additional query parameters
     * @param int $perPage Number of items per page (default 200)
     * @return array
     */
    protected function fetchAllZohoPages($endpoint, $dataKey, $options = [], $perPage = 200)
    {
        $all = [];
        $page = 1;
        do {
            $params = array_merge($options, [
                'page' => $page,
                'per_page' => $perPage,
            ]);
            $response = $this->zohoRequest($endpoint, 'get', $params);
            $data = $response->json();
            $items = $data[$dataKey] ?? [];
            $all = array_merge($all, $items);
            $hasMore = $data['page_context']['has_more_page'] ?? false;
            $page++;
        } while ($hasMore);
        return $all;
    }
}
