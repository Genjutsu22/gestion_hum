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
        Schema::create('demande_emplois', function (Blueprint $table) {
            $table->unsignedInteger('id_candidat');
            $table->unsignedInteger('id_offre');
            $table->primary(['id_candidat', 'id_offre']);
            $table->string('type_demande');
            $table->boolean('accepted');
            $table->foreign('id_candidat')->references('id_candidat')->on('candidats')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_offre')->references('id_offre')->on('offre_emplois')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_emplois');
    }
};
