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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('staff_id')->nullable();
            
    $table->unsignedBigInteger('service_id_1')->nullable();
    $table->unsignedBigInteger('service_id_2')->nullable();
    $table->unsignedBigInteger('service_id_3')->nullable();
            $table->decimal('total_amount', 8, 2);
           $table->date('order_date')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
