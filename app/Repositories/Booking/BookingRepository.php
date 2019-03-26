<?php 
namespace App\Repositories\Booking;
use App\Models\Booking;
use App\Models\UserBooking;
use App\Repositories\Booking\BookingInterface;
use DB;
class BookingRepository implements BookingInterface
{
    private $model;
    private $user_booking;
    public function __construct(Booking $model,UserBooking $user_booking){
        $this->model = $model;
        $this->user_booking = $user_booking;
    }

    public function create(array $attributes){
        return $this->model->create($attributes);
    }

    public function update(int $id, array $attributes){
        $user = $this->model->findOrFail($id);
        return (boolean) $user->whereId($id)->update($attributes);
    }
    
    public function find($id){
        return $this->model->find($id);
    }
    public function findAll(){
        return $this->model->get();
    }

    public function addMember(array $bookingUser){
        return $this->user_booking->insert($bookingUser);
    }

    public function findByUserId(int $user_id){
        $current_week= currentWeek();
        return $this->user_booking
                ->where('user_id','=',$user_id)
                ->whereBetween('booking_date',[$current_week[0],$current_week[1]])
                ->get()->toArray();
    }


    public function checkSlot(int $slot_id,int $game_id,int $date){
        $slot=$this->model->select('bookings.game_id')->with('game:id,total_games')
            ->where([
                    'bookings.slot_id' => $slot_id,
                    'bookings.game_id' => $game_id,
                 ])
              //->where(DB::raw('bookings.game.total_games'),'>=',DB::raw('count(bookings.game_id)'))   
             ->where(DB::raw("to_char(to_timestamp(booking_date),'yy-mm-dd')") , '=' , date('y-m-d', $date) )   
            ->get()->toArray(); 
        if(count($slot)) return false;
        return true;
    }

}