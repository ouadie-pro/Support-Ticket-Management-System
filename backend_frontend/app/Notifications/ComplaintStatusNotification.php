<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ComplaintStatusNotification extends Notification
{
    use Queueable;

    protected $complaint;
    protected $ancienStatut;
    protected $nouveauStatut;

    public function __construct($complaint, $ancienStatut, $nouveauStatut)
    {
        $this->complaint = $complaint;
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
            'soumis' => 'Soumis',
            'en_attente' => 'En attente',
            'en_cours' => 'En cours',
            'resolu' => 'Résolu',
            'rejete' => 'Rejeté',
        ];

        return (new MailMessage)
            ->subject("Mise à jour de votre réclamation - {$this->complaint->numero}")
            ->greeting("Bonjour {$notifiable->name},")
            ->line("Le statut de votre réclamation \"{$this->complaint->sujet}\" a été modifié.")
            ->line("**Nouveau statut :** {$statutLabels[$this->nouveauStatut]}")
            ->action('Voir la réclamation', route('complaints.show', $this->complaint->id))
            ->line('Merci de utiliser SupportPro!');
    }

    public function toArray(object $notifiable): array
    {
        $statutLabels = [
            'soumis' => 'Soumis',
            'en_attente' => 'En attente',
            'en_cours' => 'En cours',
            'resolu' => 'Résolu',
            'rejete' => 'Rejeté',
        ];

        return [
            'title' => 'Mise à jour de votre réclamation',
            'message' => "Le statut est passé à \"{$statutLabels[$this->nouveauStatut]}\"",
            'type' => 'complaint',
            'id' => $this->complaint->id,
        ];
    }
}
