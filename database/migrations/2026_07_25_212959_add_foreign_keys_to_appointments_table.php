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
        Schema::table('appointments', function (Blueprint $table) {
            // Explicitly name each constraint to prevent MySQL 1826 duplicate key errors
            $table->foreign('client_id', 'fk_app_client')
                  ->references('id')
                  ->on('clients')
                  ->onDelete('cascade');

            $table->foreign('stylist_id', 'fk_app_stylist')
                  ->references('id')
                  ->on('staff')
                  ->nullOnDelete();

            $table->foreign('service_id_1', 'fk_app_service_1')
                  ->references('id')
                  ->on('services')
                  ->nullOnDelete();

            $table->foreign('service_id_2', 'fk_app_service_2')
                  ->references('id')
                  ->on('services')
                  ->nullOnDelete();

            $table->foreign('service_id_3', 'fk_app_service_3')
                  ->references('id')
                  ->on('services')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Drop using the custom constraint names
            $table->dropForeign('fk_app_client');
            $table->dropForeign('fk_app_stylist');
            $table->dropForeign('fk_app_service_1');
            $table->dropForeign('fk_app_service_2');
            $table->dropForeign('fk_app_service_3');
        });
    }
};