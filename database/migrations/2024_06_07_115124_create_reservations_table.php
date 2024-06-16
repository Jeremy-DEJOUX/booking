<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	// database/migrations/xxxx_xx_xx_create_reservations_table.php
	public function up()
	{
		Schema::create('reservations', function (Blueprint $table) {
			$table->uuid('uid')->primary();
			$table->uuid('sceance_uid');
			$table->foreign('sceance_uid')->references('uid')->on('sceances')->onDelete('cascade');
			$table->integer('rank');
			$table->enum('status', ['open', 'expired', 'confirmed']);
			$table->integer('seats');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('reservations');
	}
};
