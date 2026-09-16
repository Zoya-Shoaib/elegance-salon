<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // Replace 'new_column_name' and type with your actual column details.
            // Using ->after() places it neatly in the database schema.
            $table->string('total_price')->nullable()->after('base_price'); 
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // This enables smooth rollbacks if you ever need them
            $table->dropColumn('total_price');
        });
    }
};