<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PrestamoCaducado extends Notification implements ShouldQueue
{
    use Queueable;

    protected $prestamo;

    public function __construct($prestamo)
    {
        $this->prestamo = $prestamo;
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
            ->subject('Recordatorio: Tienes un préstamo vencido')
            ->greeting('Hola '.$notifiable->nombre.',')
            ->line('Tienes un préstamo vencido. Por favor, devuelve el libro lo antes posible.')
            ->line('**Libro:** '.$this->prestamo->libro->titulo)
            ->line('**Fecha límite:** '.$this->prestamo->fecha_devolucion->format('d/m/Y'))
            ->line('**Días de retraso:** '.$this->prestamo->diasTranscurridos())
            ->action('Ver sitio web', url('/'))
            ->line('Gracias por usar nuestra biblioteca.');
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
