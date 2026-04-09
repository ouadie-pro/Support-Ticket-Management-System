<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ComplaintAssignedNotification extends Notification
{
    use Queueable;

    protected $complaint;

    public function __construct($complaint)
    {
        $this->complaint = $complaint;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Nouvelle réclamation assignée - {$this->complaint->numero}")
            ->greeting("Bonjour {$notifiable->name},")
            ->line("La réclamation \"{$this->complaint->sujet}\" vous a été assignée.")
            ->line("**Type :** " . ucfirst($this->complaint->type))
            ->action('Voir la réclamation', route('complaints.show', $this->complaint->id))
            ->line('Merci de traiter cette réclamation rapidement!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Nouvelle réclamation assignée',
            'message' => "Réclamation: {$this->complaint->sujet}",
            'type' => 'complaint',
            'id' => $this->complaint->id,
        ];
    }
}
