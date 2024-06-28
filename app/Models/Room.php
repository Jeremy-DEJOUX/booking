<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Room.php
class Room extends Model
{
	use HasFactory;

	protected $keyType = 'string';
	protected $primaryKey = 'uid';

	public $incrementing = false;
	protected $fillable = ['name', 'seats', 'cinema_uid', 'created_at', 'updated_at'];

	public function cinema()
	{
		return $this->belongsTo(Cinema::class, 'cinema_uid', 'uid');
	}

	public function sceances()
	{
		return $this->hasMany(Sceance::class, 'room_uid', 'uid');
	}
}
