<?php

namespace App\Models;

use Ramsey\Uuid\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cinema extends Model
{
	use HasFactory;

	protected $keyType = 'string';
	protected $primaryKey = 'uid';
	public $incrementing = false;

	public function rooms()
	{
		return $this->hasMany(Room::class, 'cinema_uid', 'uid');
	}
}
