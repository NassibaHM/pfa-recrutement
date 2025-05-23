<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('criteres', function (Blueprint $table) {
            $table->id(); // id auto-incrémentée
            $table->unsignedBigInteger('offre_id');
            $table->text('description');
            $table->integer('nombre_candidats');
            $table->date('date_selection');
            $table->date('date_entretien');
            $table->date('date_test');
            $table->string('local_entretien');
            $table->string('pieces_apporter');
            $table->text('competences_techniques');
            $table->text('competences_linguistiques');
            $table->text('competences_manageriales');
            $table->json('formation');
            $table->integer('experience');

            // Champs de pondération
            $table->integer('poids_competence_technique');
            $table->integer('poids_competence_linguistique');
            $table->integer('poids_competence_manageriale');
            $table->integer('poids_formation');
            $table->integer('poids_experience');

            // Autres
            $table->string('profile');

            // Clé étrangère
            $table->foreign('offre_id')->references('id')->on('offres')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('criteres');
    }
};