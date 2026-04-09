<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
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
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $typeLabel = $this->type === 'complaint' ? 'Réclamation' : 'Ticket';
        
        return [
            'title' => "Nouveau commentaire sur votre {$typeLabel}",
            'message' => is_object($this->comment) && isset($this->comment->contenu) ? $this->comment->contenu : (is_array($this->comment) ? ($this->comment['contenu'] ?? '') : $this->comment),
            'type' => $this->type,
            'id' => is_object($this->comment) ? ($this->comment->objet_id ?? null) : ($this->comment['objet_id'] ?? null),
            'user_id' => is_object($this->comment) && isset($this->comment->utilisateur_id) ? $this->comment->utilisateur_id : null,
        ];
    }
}
