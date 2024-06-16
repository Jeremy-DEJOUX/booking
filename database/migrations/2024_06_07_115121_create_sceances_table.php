<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up()
	{
		Schema::create('sceances', function (Blueprint $table) {
			$table->uuid('uid')->primary();
			$table->uuid('room_uid');
			$table->foreign('room_uid')->references('uid')->on('rooms')->onDelete('cascade');
			$table->uuid('movie');
			$table->dateTime('date');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('sceances');
	}
};
