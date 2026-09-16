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
        Schema::table('orders', function (Blueprint $table) {
            // Explicitly name each constraint to avoid MySQL 1826 duplicate name errors
            $table->foreign('client_id', 'fk_orders_client')
                  ->references('id')
                  ->on('clients')
                  ->onDelete('cascade');

            $table->foreign('staff_id', 'fk_orders_staff')
                  ->references('id')
                  ->on('staff')
                  ->nullOnDelete();

            $table->foreign('service_id_1', 'fk_orders_service_1')
                  ->references('id')
                  ->on('services')
                  ->nullOnDelete();

            $table->foreign('service_id_2', 'fk_orders_service_2')
                  ->references('id')
                  ->on('services')
                  ->nullOnDelete();

            $table->foreign('service_id_3', 'fk_orders_service_3')
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
        Schema::table('orders', function (Blueprint $table) {
            // Drop using the explicit constraint names
            $table->dropForeign('fk_orders_client');
            $table->dropForeign('fk_orders_staff');
            $table->dropForeign('fk_orders_service_1');
            $table->dropForeign('fk_orders_service_2');
            $table->dropForeign('fk_orders_service_3');
        });
    }
};