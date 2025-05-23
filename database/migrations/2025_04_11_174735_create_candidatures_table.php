<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('offre_id')->constrained()->onDelete('cascade');
            
            // Infos personnelles
            $table->string('nom')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('adresse')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('photo')->nullable();

            // Infos techniques
            $table->string('competences_techniques')->nullable();
            $table->string('competences_linguistiques')->nullable();
            $table->string('competences_manageriales')->nullable();
            $table->integer('experience')->nullable();
            $table->string('formation')->nullable();
            $table->string('certifications')->nullable();
            $table->text('autres_informations')->nullable();
    
            // Status and scoring
            $table->string('etat')->default('en attente');
            $table->integer('score')->nullable()->default(0);
            $table->boolean('retained')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidatures');
    }
};