<?php

namespace Modules\Developers\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Developers\Emails\AppTesterInvitation;
use Modules\Developers\Models\AppTester;
use Illuminate\Support\Facades\Mail;

class SendTesterInvitation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public AppTester $tester
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->tester->email)
            ->send(new AppTesterInvitation($this->tester, $this->tester->app));
    }
}
