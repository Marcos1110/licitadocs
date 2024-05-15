<?php

namespace App\Notifications;

use App\Models\Documento;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SignedDocumentNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Documento $documento, 
        public User $remetente
    )
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
        return ['mail', 'vonage'];
    }

    /**
     * Get the Vonage / SMS representation of the notification.
     */
    public function toVonage(object $notifiable): VonageMessage
    {
        return (new VonageMessage)
                    ->content('O documento ' . $this->documento->titulo . ' foi assinado');
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('O documento foi assinado')
                    ->greeting('Olá ' . $this->remetente->name)
                    ->line('O documento ' . $this->documento->titulo . ' foi assinado')
                    ->line('Acesse a plataforma para visualizar: ')
                    ->action('Ir para Licitadocs', url('/login'))
                    ->salutation('Agradecemos sua atenção,')
                    ->line('Atenciosamente, Equipe Licitadocs!');
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
