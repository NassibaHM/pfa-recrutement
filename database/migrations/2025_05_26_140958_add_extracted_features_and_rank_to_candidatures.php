<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('candidatures', function (Blueprint $table) {
            $table->json('extracted_features')->nullable()->after('score');
            $table->integer('rank')->nullable()->after('extracted_features');
        });
    }

    public function down(): void {
        Schema::table('candidatures', function (Blueprint $table) {
            $table->dropColumn(['extracted_features', 'rank']);
        });
    }
};