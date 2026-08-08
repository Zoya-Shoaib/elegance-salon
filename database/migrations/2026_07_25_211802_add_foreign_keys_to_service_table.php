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
    Schema::table('services', function (Blueprint $table) {
        // Pass a unique custom constraint name as the 2nd parameter
        $table->foreign('product_id_1', 'fk_services_inventory_1')
              ->references('id')
              ->on('inventories')
              ->nullOnDelete()
              ->cascadeOnUpdate();

        $table->foreign('product_id_2', 'fk_services_inventory_2')
              ->references('id')
              ->on('inventories')
              ->nullOnDelete()
              ->cascadeOnUpdate();

        $table->foreign('product_id_3', 'fk_services_inventory_3')
              ->references('id')
              ->on('inventories')
              ->nullOnDelete()
              ->cascadeOnUpdate();
    });
}

public function down(): void
{
    Schema::table('services', function (Blueprint $table) {
        
        $table->dropForeign('fk_services_inventory_1');
        $table->dropForeign('fk_services_inventory_2');
        $table->dropForeign('fk_services_inventory_3');
    });
}
    
};