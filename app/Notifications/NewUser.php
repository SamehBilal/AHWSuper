<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Carbon\Carbon;


class NewUser extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user, $notification;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user, $notification)
    {
        $this->user      = $user;
        $this->notification = $notification;
    }


    public function withDelay($notifiable): array
    {
        $delays = [];

        if (!empty($this->notification['send_date'])) {
            try {
                $scheduledTime = Carbon::createFromFormat('Y-m-d H:i:s', $this->notification['send_date']);
                $delay = now()->diffInSeconds($scheduledTime, false);

                if ($delay > 0) {
                    foreach (['mail', 'broadcast', 'database'] as $channel) {
                        if (!empty($this->notification[$channel])) {
                            $delays[$channel] = now()->addSeconds($delay);
                        }
                    }
                    return $delays;
                }
            } catch (\Exception $e) {
                // Handle invalid date format silently or log it
            }
        }

        foreach (['mail', 'broadcast', 'database'] as $channel) {
            if (!empty($this->notification[$channel])) {
                $delays[$channel] = now();
            }
        }

        return $delays;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $channels = ['broadcast'];

        foreach (['mail', 'broadcast', 'database'] as $channel) {
            if (!empty($this->notification[$channel])) {
                $channels[] = $channel;
            }
        }

        //dd( $channels);
        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {

       /*  return [
            'title'       => $this->notification['subject'],
            'message'       => $this->notification['content'],
        ]; */
    }

    public function toDatabase($notifiable)
    {
       /*  if (!empty($this->notification['whatsapp'])) {
            $this->sendTwilioWhatsApp($notifiable);
        }

        if (!empty($this->notification['sms'])) {
            $this->sendTwilioMessage($notifiable);
        } */

        /* return [
            'title'       => $this->notification['subject'],
            'message'       => $this->notification['content'],
        ]; */
    }

     /**
     * Get the broadcastable representation of the notification.
     */
    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'title'         => $this->notification['subject'],
            'message'       => $this->notification['content'],
        ]);
    }

    public function broadcastOn()
    {
        return ['Live-Updates', 'users.2'];
    }
}
