<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecruteurIdToOffresTable extends Migration
{
    public function up()
    {
        Schema::table('offres', function (Blueprint $table) {
            $table->unsignedBigInteger('recruteur_id')->nullable();
            $table->foreign('recruteur_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('offres', function (Blueprint $table) {
            $table->dropForeign(['recruteur_id']);
            $table->dropColumn('recruteur_id');
        });
    }
}