<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $tables = [
            'role_utilisateur',
            'piece_jointes',
            'commentaire_tickets',
            'historique_tickets',
            'base_connaissances',
            'reponse_predefinies',
            'escalades',
            'tickets',
        ];

        foreach ($tables as $table) {
            try {
                $fks = DB::select("PRAGMA foreign_key_list({$table})");
                foreach ($fks as $fk) {
                    if ($fk->table === 'utilisateurs') {
                        Schema::table($table, function (Blueprint $tableBlueprint) use ($fk) {
                            $tableBlueprint->dropForeign([$fk->from]);
                            $tableBlueprint->foreign($fk->from)->references('id')->on('users')->onDelete('cascade');
                        });
                    }
                }
            } catch (\Exception $e) {
                // Skip if table doesn't exist or has no foreign keys
            }
        }
    }

    public function down(): void
    {
        // Revert is complex due to different original settings, skip for now
    }
};
