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
        Schema::create('conges', function (Blueprint $table) {
            $table->increments('id_conge');
            $table->unsignedInteger('id_employe');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('certificat_medical')->unique()->nullable();
            $table->timestamp('date_demande');
            $table->boolean('etat')->nullable();
            $table->string('justif')->nullable();
            $table->string('type_conge');
            $table->timestamp('date_accept')->nullable();
            $table->foreign('id_employe')->references('id_employe')->on('employes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
