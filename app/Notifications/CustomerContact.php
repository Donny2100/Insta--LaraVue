<?php

namespace App\Notifications;

use App\Models\Place;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;

class CustomerContact extends Notification {
    use Queueable;

    private $customerName;
    private $email;
    private $phone;
    private $message;
    private $place;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Place $place, Request $request) {
        $this->customerName    = $request->name;
        $this->customerEmail   = $request->email;
        $this->customerPhone   = $request->phone_number;
        $this->customerMessage = $request->message;
        $this->place           = $place;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable) {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        return (new MailMessage)
                    ->subject("[{$this->place->name}] - New contact message")
                    ->greeting("Dear {$this->place->owner->name}")
                    ->line("You have just received a new message about {$this->place->name}:")
                    ->line('')
                    ->line("Customer name: {$this->customerName}")
                    ->line("Customer e-mail: {$this->customerEmail}")
                    ->line("Customer phone: {$this->customerPhone}")
                    ->line("Customer message: {$this->customerMessage}");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [];
    }
}
