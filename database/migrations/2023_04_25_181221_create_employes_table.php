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
        Schema::create('employes', function (Blueprint $table) {
            $table->increments('id_employe');
            $table->unsignedInteger('id_personne');
            $table->unsignedInteger('id_prof');
            $table->unsignedInteger('id_depart');
            $table->unsignedInteger('num_bureau');
            $table->foreign('id_personne')->references('id_personne')->on('personnes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_prof')->references('id_prof')->on('professions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_depart')->references('id_depart')->on('departements')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
