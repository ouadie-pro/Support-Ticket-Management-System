<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Ticket;
use App\Models\Complaint;
use App\Models\User;
use App\Notifications\NewCommentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function storeTicketComment(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'contenu' => 'required|string',
        ]);

        $comment = Commentaire::create([
            'utilisateur_id' => Auth::id(),
            'objet_type' => Ticket::class,
            'objet_id' => $ticket->id,
            'contenu' => $validated['contenu'],
        ]);

        if ($ticket->client && $ticket->client->email) {
            $clientUser = User::where('email', $ticket->client->email)->first();
            if ($clientUser && $clientUser->id !== Auth::id()) {
                $clientUser->notify(new NewCommentNotification($comment, 'ticket', $ticket->sujet));
            }
        }

        if ($ticket->assigne_a && $ticket->assigne_a !== Auth::id()) {
            $agent = User::find($ticket->assigne_a);
            if ($agent) {
                $agent->notify(new NewCommentNotification($comment, 'ticket', $ticket->sujet));
            }
        }

        return redirect()->route('tickets.show', $ticket->id);
    }

    public function storeComplaintComment(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'contenu' => 'required|string',
        ]);

        $comment = Commentaire::create([
            'utilisateur_id' => Auth::id(),
            'objet_type' => Complaint::class,
            'objet_id' => $complaint->id,
            'contenu' => $validated['contenu'],
        ]);

        if ($complaint->user && $complaint->user->id !== Auth::id()) {
            $complaint->user->notify(new NewCommentNotification($comment, 'complaint', $complaint->sujet));
        }

        if ($complaint->traite_par && $complaint->traite_par !== Auth::id()) {
            $agent = User::find($complaint->traite_par);
            if ($agent) {
                $agent->notify(new NewCommentNotification($comment, 'complaint', $complaint->sujet));
            }
        }

        return redirect()->route('complaints.show', $complaint->id);
    }

    public function destroy(Commentaire $comment)
    {
        $comment->delete();
        return back();
    }
}
