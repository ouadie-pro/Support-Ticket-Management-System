<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification
{
    use Queueable;

    protected $comment;
    protected $type;
    protected $title;

    public function __construct($comment, $type = 'ticket', $title = '')
    {
        $this->comment = $comment;
        $this->type = $type;
        $this->title = $title;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $typeLabel = $this->type === 'complaint' ? 'réclamation' : 'ticket';
        
        return (new MailMessage)
            ->subject("Nouveau commentaire sur votre {$typeLabel}")
            ->greeting("Bonjour {$notifiable->name},")
            ->line("Un nouveau commentaire a été ajouté sur votre {$typeLabel}: {$this->title}")
            ->line('"' . $this->comment->contenu . '"')
            ->action('Voir le ' . $typeLabel, $this->getUrl())
            ->line('Merci de utiliser notre application!');
    }

    public function toArray(object $notifiable): array
    {
        $typeLabel = $this->type === 'complaint' ? 'Réclamation' : 'Ticket';
        
        return [
            'title' => "Nouveau commentaire sur votre {$typeLabel}",
            'message' => $this->comment->contenu,
            'type' => $this->type,
            'id' => $this->comment->objet_id,
            'user_id' => $this->comment->utilisateur_id,
        ];
    }

    protected function getUrl(): string
    {
        if ($this->type === 'complaint') {
            return route('complaints.show', $this->comment->objet_id);
        }
        return route('tickets.show', $this->comment->objet_id);
    }
}
