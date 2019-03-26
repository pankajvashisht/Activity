<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\v1\ApiController;
use App\Repositories\Booking\BookingRepository;
use Illuminate\Support\Facades\Validator;


class BookingsController extends ApiController
{
    private $booking;
    public function __construct(BookingRepository $booking){
        $this->booking = $booking;
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'slot_id' => 'required| integer |exists:slots,id',
            'game_id' => 'required| integer |exists:games,id',
            'user_id' => 'required| integer |exists:users,id',
            'booking_date' => 'required',
            'players' => 'required',
        ]);
        if ($validator->fails()) {
             return $this->error(400,$validator->messages());
        }
        $requestdata=$request->all();
        if(!$this->booking->checkSlot($requestdata['slot_id'],$requestdata['game_id'],$requestdata['booking_date'])){
            return $this->error(422,'Selected Slot is not free');
        }
        if(count($this->booking->findByUserId($requestdata['user_id']))==2){
            return $this->error(401,'Your All slots are booked');
        }
        $users=explode(',',$requestdata['players']);
        $users[]=$requestdata['user_id'];
        if($booking=$this->booking->create($requestdata)){
            $this->addMember($users,$booking->id,$requestdata['booking_date']);
            return $this->success([],'Your Booking create Successfully');
            
        }
        return $this->error(422,'Error to create booking');
    }

    private function addMember(array $users,$booking_id,$booking_date){
        $add_booking=[];
        foreach($users as $key => $val){
            $add_booking[]=[
                'user_id' => $val,
                'booking_id' => $booking_id,
                'booking_date' =>  $booking_date
            ];
        }
        $this->booking->addMember($add_booking);
    }

}
