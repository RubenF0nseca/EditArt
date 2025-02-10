<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public $token)
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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $resetUrl = URL::temporarySignedRoute(
            'password.reset', // Nome da rota
            Carbon::now()->addMinutes(1440), // Validade de 24 horas (1440 minutos)
            ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()]
        );

        return (new MailMessage)
            ->subject("Pedido de Reset da Password")
            ->greeting("Olá {$notifiable->name},")
            ->line("Estás a receber este email porque foi efetuado um pedido de reset de password para a sua conta.")
            ->action("Alterar Password", $resetUrl)
            ->line("Este link é válido por 24 horas.")
            ->salutation("Atenciosamente, EditArt");
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
