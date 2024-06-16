<?php

// app/Models/Reservation.php
// app/Models/Reservation.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
	use HasFactory;

	protected $keyType = 'string';
	public $incrementing = false;
	protected $primaryKey = 'uid';

	protected $fillable = [
		'uid', 'sceance_uid', 'rank', 'status', 'seats'
	];

	public function sceance()
	{
		return $this->belongsTo(Sceance::class, 'sceance_uid', 'uid');
	}
}
