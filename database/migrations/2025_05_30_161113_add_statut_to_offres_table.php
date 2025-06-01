<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('offres', 'statut')) {
            Schema::table('offres', function (Blueprint $table) {
                $table->enum('statut', ['active', 'fermee', 'suspendue'])
                      ->default('active')
                      ->after('date_selection');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('offres', 'statut')) {
            Schema::table('offres', function (Blueprint $table) {
                $table->dropColumn('statut');
            });
        }
    }
};