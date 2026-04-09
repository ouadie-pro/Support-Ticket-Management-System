<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Ticket;
use App\Models\Complaint;
use App\Models\User;
use App\Models\JournalActivite;
use App\Notifications\NewCommentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function storeTicketComment(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'contenu' => 'required|string',
        ], [
            'contenu.required' => 'Le message ne peut pas être vide.',
        ]);

        $comment = Commentaire::create([
            'utilisateur_id' => Auth::id(),
            'objet_type' => Ticket::class,
            'objet_id' => $ticket->id,
            'contenu' => $validated['contenu'],
        ]);

        JournalActivite::create([
            'utilisateur_id' => Auth::id(),
            'action' => 'comment_added',
            'objet_type' => Ticket::class,
            'objet_id' => $ticket->id,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        if ($ticket->assigne_a && $ticket->assigne_a !== Auth::id()) {
            $agent = User::find($ticket->assigne_a);
            if ($agent) {
                $agent->notify(new NewCommentNotification($comment, 'ticket', $ticket->sujet));
            }
        }

        if ($ticket->client && $ticket->client->user && $ticket->client->user->id !== Auth::id()) {
            $ticket->client->user->notify(new NewCommentNotification($comment, 'ticket', $ticket->sujet));
        }

        $admins = User::whereHas('role', function($q) {
            $q->where('code', 'admin');
        })->where('id', '!=', Auth::id())->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewCommentNotification($comment, 'ticket', $ticket->sujet));
        }

        return redirect()->route('tickets.show', $ticket->id)->with('success', 'Réponse ajoutée.');
    }

    public function storeComplaintComment(Request $request, Complaint $complaint)
    {
        $validated = $request->validate([
            'contenu' => 'required|string',
        ], [
            'contenu.required' => 'Le message ne peut pas être vide.',
        ]);

        $comment = Commentaire::create([
            'utilisateur_id' => Auth::id(),
            'objet_type' => Complaint::class,
            'objet_id' => $complaint->id,
            'contenu' => $validated['contenu'],
        ]);

        JournalActivite::create([
            'utilisateur_id' => Auth::id(),
            'action' => 'comment_added',
            'objet_type' => Complaint::class,
            'objet_id' => $complaint->id,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
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

        $admins = User::whereHas('role', function($q) {
            $q->where('code', 'admin');
        })->where('id', '!=', Auth::id())->get();

        foreach ($admins as $admin) {
            $admin->notify(new NewCommentNotification($comment, 'complaint', $complaint->sujet));
        }

        return redirect()->route('complaints.show', $complaint->id)->with('success', 'Réponse ajoutée.');
    }

    public function destroy(Request $request, Commentaire $comment)
    {
        if ($comment->utilisateur_id !== Auth::id()) {
            abort(403, 'Vous ne pouvez pas supprimer ce commentaire.');
        }

        $comment->delete();

        return back()->with('success', 'Commentaire supprimé.');
    }
}
