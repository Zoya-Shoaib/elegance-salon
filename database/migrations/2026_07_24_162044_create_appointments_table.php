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
       

    Schema::create('appointments', function (Blueprint $table) {
    $table->id();

    
    $table->unsignedBigInteger('client_id');
    $table->unsignedBigInteger('stylist_id')->nullable(); 
    $table->unsignedBigInteger('service_id_1')->nullable();
    $table->unsignedBigInteger('service_id_2')->nullable();
    $table->unsignedBigInteger('service_id_3')->nullable();

    $table->date('appointment_date');
    $table->time('appointment_time');
    $table->timestamps();
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};