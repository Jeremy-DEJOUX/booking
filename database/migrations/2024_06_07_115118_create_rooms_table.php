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
		Schema::create('rooms', function (Blueprint $table) {
			$table->uuid('uid')->primary();
			$table->uuid('cinema_uid');
			$table->foreign('cinema_uid')->references('uid')->on('cinemas')->onDelete('cascade');
			$table->string('name', 128);
			$table->integer('seats');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('rooms');
	}
};
