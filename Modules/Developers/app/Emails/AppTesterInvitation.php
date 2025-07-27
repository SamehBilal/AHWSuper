<?php

namespace Modules\Developers\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Modules\Developers\Models\AppTester;
use Modules\Developers\Models\Client;

class AppTesterInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public AppTester $tester,
        public Client $app
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "You're invited to test {$this->app->name} on Arabhardware",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'developers::emails.app-tester-invitation',
            with: [
                'acceptUrl' => route('app-tester.accept', $this->tester->invitation_token),
                'rejectUrl' => route('app-tester.reject', $this->tester->invitation_token),
                'appUrl' => config('app.url'),
            ]
        );
    }

    /**
     * Build the message.
     */
    public function build(): self
    {
        return $this->view('view.name');
    }
}
