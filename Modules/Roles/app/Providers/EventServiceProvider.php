<?php

namespace Modules\Roles\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            'SocialiteProviders\\Discord\\DiscordExtendSocialite@handle',
            'SocialiteProviders\\Twitch\\TwitchExtendSocialite@handle',
            'SocialiteProviders\\TikTok\\TikTokExtendSocialite@handle',
            'SocialiteProviders\\Apple\\AppleExtendSocialite@handle',
            'SocialiteProviders\\Amazon\\AmazonExtendSocialite@handle',
            'SocialiteProviders\\Microsoft\\MicrosoftExtendSocialite@handle',
            'SocialiteProviders\\Slack\\SlackExtendSocialite@handle',
        ],
    ];

    /**
     * Indicates if events should be discovered.
     *
     * @var bool
     */
    protected static $shouldDiscoverEvents = true;

    /**
     * Configure the proper event listeners for email verification.
     */
    protected function configureEmailVerification(): void {}
}
