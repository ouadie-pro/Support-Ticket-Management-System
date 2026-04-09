<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('journal_activites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')
                  ->nullable()
                  ->constrained('utilisateurs')
                  ->nullOnDelete();
            $table->string('action');
            $table->string('objet_type')->nullable();
            $table->unsignedBigInteger('objet_id')->nullable();
            $table->string('ip')->nullable();
            $table->text('user_agent')->nullable();
            $table->json('donnees_avant')->nullable();
            $table->json('donnees_apres')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index(['objet_type','objet_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journal_activites');
    }
};