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
        Schema::create('piece_jointes', function (Blueprint $table) {
           $table->id();
           $table->string('objet_type');
           $table->unsignedBigInteger('objet_id');
           $table->string('nom_fichier');
           $table->string('chemin');
           $table->string('mime')->nullable();
           $table->integer('taille')->nullable();
           $table->foreignId('uploaded_by')->constrained('utilisateurs');
           $table->timestamps();
           $table->index(['objet_type', 'objet_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piece_jointes');
    }
};
