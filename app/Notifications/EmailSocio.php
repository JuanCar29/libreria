<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailSocio extends Notification implements ShouldQueue
{
    use Queueable;

    protected $datos;

    public function __construct($datos)
    {
        $this->datos = $datos;
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
        return (new MailMessage)
            ->subject($this->datos['asunto'])
            ->greeting('Hola '.$notifiable->nombre)
            ->line('Queremos informarte de lo siguiente:')
            ->line($this->datos['cuerpo'])
            ->action('Ir a la web', url('/'))
            ->line('Si tienes dudas, responde a este correo o visita nuestra web.')
            ->salutation('Atentamente, el equipo de Soporte');
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
