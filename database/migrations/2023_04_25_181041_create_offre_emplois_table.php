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
        Schema::create('offre_emplois', function (Blueprint $table) {
            $table->increments('id_offre');
            $table->unsignedInteger('id_prof');
            $table->unsignedInteger('id_depart');
            $table->string('detail');
            $table->timestamp('date_pub');
            $table->string('type_emploi');
            $table->boolean('termine')->nullable();
            $table->foreign('id_prof')->references('id_prof')->on('professions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_depart')->references('id_depart')->on('departements')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offre_emplois');
    }
};
