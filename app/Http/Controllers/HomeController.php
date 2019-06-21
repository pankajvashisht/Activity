<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Booking\BookingRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $booking;
    public function __construct(BookingRepository $booking)
    {
        //$this->middleware('auth');
        $this->booking = $booking;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = $this->booking->allbooking();
        echo "<pre>";
        print_r($data);
        die;
        return view('home');
    }
}
