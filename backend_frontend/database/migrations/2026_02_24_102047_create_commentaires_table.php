<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')
                  ->constrained('utilisateurs')
                  ->onDelete('cascade');
            $table->string('objet_type');
            $table->unsignedBigInteger('objet_id');
            $table->text('contenu');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['objet_type','objet_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('commentaires');
    }
};