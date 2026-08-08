File database/migrations/2026_07_19_000001_create_clients_table.php
<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
/**
* Run the migrations.
*/ public function up(): void
{
Schema::create('clients', function (Blueprint $table) {
$table->id();
$table->string('name');
$table->string('email')->unique();
$table->string('phone')->nullable();
$table->string('preferences')->nullable(); $table->text('notes')->nullable();
$table->boolean('is_vip')->default(false);
$table->year('member_since')->nullable();
$table->unsignedInteger('total_visits')->default(0);
$table->date('last_visit_at')->nullable();
$table->string('last_service')->nullable();
$table->timestamps();
});
}
/**
* Reverse the migrations.
*/ public function down(): void
{
Schema::dropIfExists('clients');
}
};