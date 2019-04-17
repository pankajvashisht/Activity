<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\Booking as BookingMail;
use App\Repositories\Booking\BookingRepository;
use Mail;

class Sendmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookingMail:send {booking_id} --queue';

    /**
     * The console command description.
     *
     * @var string
     */

    private $booking;

    protected $description = 'send booking mail';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(BookingRepository $booking)
    {
        parent::__construct();
        $this->booking = $booking;
        
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
       
        $bookings = $this->booking->bookingDetails($this->argument('booking_id'));
        foreach($bookings as $booking):
            Mail::to($booking['user']['email'])->send(
                new BookingMail($bookings)
            );
        endforeach;
        $this->info('mail send successfully'); // green
    }
}
