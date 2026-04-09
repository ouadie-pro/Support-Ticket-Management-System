<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('sujet');
            $table->text('description');
            $table->enum('type', ['technique', 'facturation', 'service', 'autre'])->default('autre');
            $table->enum('priorite', ['faible', 'moyenne', 'haute', 'urgente'])->default('moyenne');
            $table->enum('statut', ['soumis', 'en_attente', 'en_cours', 'resolu', 'rejete'])->default('soumis');
            $table->foreignId('traite_par')->nullable()->constrained('users')->onDelete('set null');
            $table->date('date_resolution')->nullable();
            $table->text('resolution')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
