<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::rename('notifications', 'custom_notifications');
    }

    public function down()
    {
        Schema::rename('custom_notifications', 'notifications');
    }
};