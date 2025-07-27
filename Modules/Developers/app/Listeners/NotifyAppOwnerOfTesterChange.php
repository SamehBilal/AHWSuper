<?php

namespace Modules\Developers\Listeners;

use Modules\Developers\Events\TesterStatusChanged;
use Modules\Developers\Notifications\TesterStatusChanged as TesterStatusChangedNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAppOwnerOfTesterChange
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(TesterStatusChanged $event): void
    {
        $appOwner = $event->tester->oauthApp->user;

        $appOwner->notify(
            new TesterStatusChangedNotification(
                $event->tester,
                $event->tester->status
            )
        );
    }
}
