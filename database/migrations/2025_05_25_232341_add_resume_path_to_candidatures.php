<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('candidatures', function (Blueprint $table) {
            $table->string('resume_path')->nullable()->after('offre_id');
        });
    }

    public function down(): void {
        Schema::table('candidatures', function (Blueprint $table) {
            $table->dropColumn('resume_path');
        });
    }
};