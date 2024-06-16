<?php

// app/Models/Sceance.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sceance extends Model
{
	use HasFactory;

	protected $keyType = 'string';
	public $incrementing = false;
	protected $primaryKey = 'uid';

	protected $fillable = [
		'uid', 'room_uid', 'movie', 'date'
	];

	public function room()
	{
		return $this->belongsTo(Room::class, 'room_uid', 'uid');
	}

	public function reservations()
	{
		return $this->hasMany(Reservation::class, 'sceance_uid', 'uid');
	}
}
