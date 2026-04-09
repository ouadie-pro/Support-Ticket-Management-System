<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketStatusNotification extends Notification
{
    use Queueable;

    protected $ticket;
    protected $ancienStatut;
    protected $nouveauStatut;

    public function __construct($ticket, $ancienStatut, $nouveauStatut)
    {
        $this->ticket = $ticket;
        $this->ancienStatut = $ancienStatut;
        $this->nouveauStatut = $nouveauStatut;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $statutLabels = [
            'ouvert' => 'Ouvert',
            'en_cours' => 'En cours',
            'resolu' => 'Résolu',
            'ferme' => 'Fermé',
        ];

        return (new MailMessage)
            ->subject("Mise à jour de votre ticket - {$this->ticket->numero}")
            ->greeting("Bonjour {$notifiable->name},")
            ->line("Le statut de votre ticket \"{$this->ticket->sujet}\" a été modifié.")
            ->line("**Nouveau statut :** {$statutLabels[$this->nouveauStatut]}")
            ->action('Voir le ticket', route('tickets.show', $this->ticket->id))
            ->line('Merci de utiliser SupportPro!');
    }

    public function toArray(object $notifiable): array
    {
        $statutLabels = [
            'ouvert' => 'Ouvert',
            'en_cours' => 'En cours',
            'resolu' => 'Résolu',
            'ferme' => 'Fermé',
        ];

        return [
            'title' => 'Mise à jour de votre ticket',
            'message' => "Le statut est passé à \"{$statutLabels[$this->nouveauStatut]}\"",
            'type' => 'ticket',
            'id' => $this->ticket->id,
        ];
    }
}
