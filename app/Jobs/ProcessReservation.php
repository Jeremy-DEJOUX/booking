<?php
// app/Jobs/ProcessReservation.php
namespace App\Jobs;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessReservation implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $reservation;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct(Reservation $reservation)
	{
		$this->reservation = $reservation;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		// Logique pour traiter la réservation
		$this->reservation->rank = Reservation::where('sceance_uid', $this->reservation->sceance_uid)->count();
		$this->reservation->save();
	}
}
