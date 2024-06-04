<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cinema extends Model
{
	use HasFactory;

	public $keyType = 'string';
	public $incrementing = false;

	public static function booted(): void
	{
		static::creating(function ($cinema) {
			$cinema->id = Uuid::uuid4();
		});
	}
}
