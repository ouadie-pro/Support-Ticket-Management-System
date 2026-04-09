<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('s_l_a_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categorie_ticket_id')->unique()->constrained('categorie_tickets');
            $table->integer('delai_premiere_reponse_h')->default(24);
            $table->integer('delai_resolution_h')->default(72);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('s_l_a_s');
    }
};
