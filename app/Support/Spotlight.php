<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Modules\AHWStore\Http\Traits\ZohoApiTrait;
use Illuminate\Support\Facades\Auth;
use Exception;

class Spotlight
{
    use ZohoApiTrait;
    public function search(Request $request)
    {
        // Guests can not search
        if(! Auth::user()) {
            return [];
        }

        return collect()
            ->merge($this->applications($request->search))
            ->merge($this->actions($request->search))
            ->merge($this->users($request->search));
    }

    // Database search
    public function users(string $search = '')
    {
        return User::query()
                ->where('name', 'like', "%$search%")
                ->take(5)
                ->get()
                ->map(function (User $user) {
                    return [
                        'avatar' => $user->profile_picture ?? "https://avatar.iran.liara.run/public",
                        'name' => $user->name,
                        'description' => $user->email,
                        'link' => "/users/{$user->id}"
                    ];
                });
    }

    public function applications(string $search = '')
    {
        $user = Auth::user();
        $clients = $user->oauthApps()->get();
        return $clients
                ->filter(fn($client) => str($client->name)->contains($search, true))
                ->take(5)
                ->map(function ($client,$icon) {
                    return [
                        'avatar'        => asset('app.webp'),
                        'name'          => $client->name,
                        'description'   => $client->id,
                        'link'          => "/developers/apps"
                    ];
                });
    }

    public function items(string $search = '')
    {
        try {
            $response = $this->zohoRequest('items');
            $data = $response->json();
            return $data['items']->map(function ($item) {
                    return [
                        'avatar' => $item->profile_picture ?? "https://avatar.iran.liara.run/public",
                        'name' => $item->name,
                        'description' => $item->email,
                        'link' => "/users/{$item->id}"
                    ];
                });
        } catch (Exception $e) {
            return response()->json(['error' => 'Failed to fetch items: ' . $e->getMessage()], 500);
        }
    }

    // Static search, but it could come from a database
    public function actions(string $search = '')
    {

        return collect([
            [
                'icon'          => Blade::render("<x-mary-icon name='o-plus' class='w-11 h-11 p-2 bg-primary/10 rounded-full' />"),
                'name'          => 'Create user',
                'description'   => 'Create a new user',
                'link'          => '/users/create'
            ],
            [
                'icon'          => Blade::render("<x-mary-icon name='o-plus' class='w-11 h-11 p-2 bg-primary/10 rounded-full' />"),
                'name'          => 'Create App',
                'description'   => 'Create a new app',
                'link'          => '/users/create'
            ]
        ])->filter(fn(array $item) => str($item['name'] . $item['description'])->contains($search, true));
    }
}
