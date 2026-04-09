<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('slas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categorie_ticket_id')
                  ->constrained('categorie_tickets')
                  ->onDelete('cascade');
            $table->integer('delai_premiere_reponse_h');
            $table->integer('delai_resolution_h');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slas');
    }
};