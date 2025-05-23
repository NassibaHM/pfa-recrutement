<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffresTable extends Migration
{
    public function up()
    {
        Schema::create('offres', function (Blueprint $table) {
            $table->id();
            $table->string('profile');
            $table->text('description');
            $table->json('formation')->nullable();
            $table->text('competences_techniques');
            $table->text('competences_linguistiques');
            $table->text('competences_manageriales');
            $table->integer('experience');
            $table->date('date_entretien');
            $table->date('date_selection');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('offres');
    }
}