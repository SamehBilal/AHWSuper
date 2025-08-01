<?php

namespace Modules\Developers\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Modules\Developers\Models\AppTester;

class TesterStatusChanged extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
     public function __construct(
        public AppTester $tester,
        public string $action
    ) {}

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $status = $this->action === 'accepted' ? 'accepted' : 'declined';

        return (new MailMessage)
            ->subject("Tester {$status} your invitation")
            ->line("{$this->tester->user->name} has {$status} your testing invitation for {$this->tester->app->name}.")
            ->action('View Application', route('developer.apps.show', $this->tester->app))
            ->line('Thank you for using Arabhardware Developers Platform!');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'client_id'        => $this->tester->oauth_client_id,
            'app_name'      => $this->tester->app->name,
            'tester_name'   => $this->tester->user->name,
            'action'        => $this->action,
        ];
    }
}
