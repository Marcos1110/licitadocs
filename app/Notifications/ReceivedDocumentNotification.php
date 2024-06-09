<?php

namespace App\Notifications;

use App\Models\Documento;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notification;

class ReceivedDocumentNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Documento $documento, 
        public User $destinatario,
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
                    ->content('Você recebe o documento ' . $this->documento->titulo . ' de ' . $this->remetente->name);
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Você recebeu um novo documento')
                    ->greeting('Olá ' . $this->destinatario->name)
                    ->line('Você recebeu o documento ' . $this->documento->titulo . ' de ' . $this->remetente->name)
                    ->line('Acesse a plataforma para visualizar: ')
                    ->action('Ir para Licitadocs', url('/'))
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
