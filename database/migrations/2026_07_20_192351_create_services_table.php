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
       Schema::create('services', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('category');
    $table->text('description')->nullable();
    $table->decimal('base_price', 8, 2);

    // Shorthand Foreign Keys
    $table->foreignId('product_id_1')->nullable()->constrained('inventories')->nullOnDelete();
    $table->foreignId('product_id_2')->nullable()->constrained('inventories')->nullOnDelete();
    $table->foreignId('product_id_3')->nullable()->constrained('inventories')->nullOnDelete();
    $table->decimal('total_price',8,2);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
