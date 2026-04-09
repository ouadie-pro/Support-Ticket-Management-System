<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->foreignId('client_id')
                  ->constrained('clients')
                  ->onDelete('cascade');
            $table->string('sujet');
            $table->text('description');
            $table->enum('priorite', ['faible','moyenne','haute','urgente'])
                  ->default('moyenne');
            $table->enum('statut', ['ouvert','en_cours','resolu','ferme'])
                  ->default('ouvert');
            $table->foreignId('categorie_id')
                  ->nullable()
                  ->constrained('categorie_tickets')
                  ->onDelete('set null');
            $table->foreignId('assigne_a')
                  ->nullable()
                  ->constrained('utilisateurs')
                  ->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};