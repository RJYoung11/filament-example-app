<?php

namespace App\Notifications;

use App\Models\Customers;
use App\Models\User;
use Filament\Notifications\Events\DatabaseNotificationsSent;
use Filament\Notifications\Http\Livewire\Notifications;
use Filament\Notifications\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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
        $getUserAdmin = User::where('email', 'admin@admin.com')->first();
        if (!empty($customers))
            Notification::make()
                ->title('Customer ' . $customers->firstname . ' ' . $customers->lastname . ' added successfully!')
                ->sendToDatabase($getUserAdmin);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        logger($notifiable);
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
