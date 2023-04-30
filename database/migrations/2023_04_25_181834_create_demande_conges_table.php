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
        Schema::create('demande_conges', function (Blueprint $table) {
            $table->unsignedInteger('id_conge');
            $table->unsignedInteger('id_employe');
            $table->primary(['id_conge', 'id_employe']);
            $table->boolean('etat');
            $table->string('justif');
            $table->foreign('id_conge')->references('id_conge')->on('conges')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_employe')->references('id_employe')->on('employes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_conges');
    }
};
