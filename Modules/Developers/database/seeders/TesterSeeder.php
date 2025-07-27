<?php

namespace Modules\Developers\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Developers\Models\AppTester;
use Modules\Developers\Models\Client;

class TesterSeeder extends Seeder
{
    public function run(): void
    {
        $apps = Client::all();
        $users = User::all();

        foreach ($apps as $app) {
            // Add 3-5 random testers per app
            $testerCount = rand(3, 5);
            $selectedUsers = $users->random($testerCount);

            foreach ($selectedUsers as $user) {
                if ($user->id !== $app->user_id) { // Don't make owner a tester
                    AppTester::create([
                        'oauth_app_id' => $app->id,
                        'user_id' => $user->id,
                        'invited_by' => $app->user_id,
                        'email' => $user->email,
                        'message' => 'Please help test my application!',
                        'status' => ['pending', 'accepted', 'rejected'][rand(0, 2)],
                        'invitation_token' => Str::random(40),
                        'accepted_at' => rand(0, 1) ? now()->subDays(rand(1, 30)) : null,
                    ]);
                }
            }
        }
    }
}
