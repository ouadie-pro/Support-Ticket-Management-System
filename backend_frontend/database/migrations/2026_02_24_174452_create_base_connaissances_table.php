<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('base_connaissances', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('slug')->unique();
            $table->text('contenu');
            $table->foreignId('categorie_id')
                  ->nullable()
                  ->constrained('categorie_tickets')
                  ->nullOnDelete();
            $table->enum('statut', ['brouillon','publie'])
                  ->default('brouillon');
            $table->foreignId('created_by')
                  ->constrained('utilisateurs')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('base_connaissances');
    }
};