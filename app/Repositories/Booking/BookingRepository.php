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
                ->with('user:id,name')
                ->with('booking')
                ->where('user_id','=',$user_id)
                ->whereBetween('booking_date',[$current_week[0],$current_week[1]])
                ->get()->toArray();
    }

    public function userBookings(int $user_id){
         $current_week= currentWeek();
         $booking = $this->user_booking
                ->select('booking_id')
                ->with(['booking' => function ($query) {
                    $query->with('game:id,name,image')->with('slot:id,to,from')->with('user:id,name,email');
                 }])
                 ->whereBetween('booking_date',[$current_week[0],$current_week[1]])
                 ->where('user_id','=',$user_id)
                 ->get()->toArray();
          if(count($booking)>0){       
            $booking_ids=[];       
            foreach($booking as $val):
                $booking_ids[]=$val['booking_id'];
            endforeach; 
            $users = $this->user_booking->with('user:id,email,name,social_image')
            ->whereIn('booking_id',$booking_ids)
            ->get()->toArray();
            foreach($booking as $key => $value){
                $booking[$key]['players'] = self::getBookinguser($users,$value['booking_id']); 
            }
          }
          return $booking;      
    }

    public  function bookingDetails(int $booking_id){
        return $this->user_booking
                ->select(['booking_id','user_id'])
                ->with('user:id,email,name,social_image')
                ->with(['booking' => function ($query) {
                    $query->with('game:id,name,image')->with('slot:id,to,from')->with('user:id,name,email');
                 }])
                ->where('booking_id','=',$booking_id)
                ->get()->toArray();
    }


    public function AllBookings(){
        $current_week= currentWeek();
        $time = strtotime('-6 hour',time());
        $booking = $this->user_booking
               ->select('booking_id')
               ->with(['booking' => function ($query) {
                   $query->with('game:id,name,image')->with('slot:id,to,from')->with('user:id,name,email');
                }])
                ->whereBetween('booking_date',[$time,$current_week[1]])
                ->groupBy('booking_id')
                ->get()->toArray();
         if(count($booking)>0){       
           $booking_ids=[];       
           foreach($booking as $val):
               $booking_ids[]=$val['booking_id'];
           endforeach; 
           $users = $this->user_booking->with('user:id,email,name,social_image')
           ->whereIn('booking_id',$booking_ids)
           ->get()->toArray();
           foreach($booking as $key => $value){
               $booking[$key]['players'] = self::getBookinguser($users,$value['booking_id']); 
           }
         }
         return $booking;      
   }


    private static function getBookinguser(array $users,int $booking_id ){
        $final=[];
        foreach ($users as $key => $value) {
            if($value['booking_id']==$booking_id){
                $final[]=$value['user'];
            }
        }
        return $final;
    }


    public function checkSlot(int $slot_id,int $game_id,int $date){
        $slot=$this->model->select('bookings.game_id')->with('game:id,total_games')
            ->where([
                    'bookings.slot_id' => $slot_id,
                    'bookings.game_id' => $game_id,
                 ])  
            ->where(DB::raw("to_char(to_timestamp(booking_date),'yy-mm-dd')") , '=' , date('y-m-d', $date) )   
            ->get()->toArray(); 
        if(count($slot) && count($slot) >= $slot[0]['game']['total_games']) return false;
        return true;
    }

    public function findMemberStatus(array $users){
        $current_week= currentWeek();
        $data = $this->user_booking
                ->with('user:id,name')
                ->select('user_id')
                ->whereIn('user_bookings.user_id',$users)
                ->whereBetween('booking_date',[$current_week[0],$current_week[1]])
                ->groupBy('user_bookings.user_id')
                ->havingRaw('count(user_id) = ?', [2])
                ->get()->toArray();
        if($data){
            $data =  array_column($data,'user');
        }        
        return $data;
    }


    public function deleteBooking($booking_id){
        DB::beginTransaction();
        if($this->model->where('id', '=', $booking_id)->delete()){
            $this->user_booking->where('booking_id','=',$booking_id)
            ->delete();
        }
        DB::commit();
        return true;
    }


    public function bookingIdWithSlot($booking_id){
        return $this->model->with('slot:id,to,from')
            ->where('id','=',$booking_id)
            ->first()
            ->toArray();
    }

}