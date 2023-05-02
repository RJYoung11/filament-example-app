<?php

namespace App\Notifications;

use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;

class CustomerAdded extends Notification
{
    use Queueable, Notifiable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($customers)
    {
        $getUserAdmin = User::where('isAdmin', 1)->first();
        if (! empty($customers)) {
            Notification::make()
                ->title('Customer '.$customers->firstname.' '.$customers->lastname.' added successfully!')
                ->sendToDatabase($getUserAdmin)
                ->toBroadcast();
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // public function toArray($notifiable)
    // {
    //     return [
    //         //
    //     ];
    // }
    public function toArray(): array
    {
        return Notification::make()
            ->title('Saved successfully')
            ->getDatabaseMessage();
    }
}
