<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserLoggedInNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public string $name)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', "database"];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject("Novo Login efetuado")
                    ->greeting("Olá {$notifiable->name},")
                    ->line("Foi detetado um novo login na sua conta")
                    ->action("Se não foste tu, clica aqui!", url("/login"))
                    ->salutation("Atenciosamente, Edit Art");
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            "message" => "Novo Login na conta",
            "name" => $this->name
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
