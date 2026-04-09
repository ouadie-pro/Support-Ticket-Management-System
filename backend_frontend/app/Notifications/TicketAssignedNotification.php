<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketAssignedNotification extends Notification
{
    use Queueable;

    protected $ticket;

    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Nouveau ticket assigné - {$this->ticket->numero}")
            ->greeting("Bonjour {$notifiable->name},")
            ->line("Le ticket \"{$this->ticket->sujet}\" vous a été assigné.")
            ->line("**Priorité :** " . ucfirst($this->ticket->priorite))
            ->action('Voir le ticket', route('tickets.show', $this->ticket->id))
            ->line('Merci de traiter ce ticket rapidement!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Nouveau ticket assigné',
            'message' => "Ticket: {$this->ticket->sujet}",
            'type' => 'ticket',
            'id' => $this->ticket->id,
        ];
    }
}
