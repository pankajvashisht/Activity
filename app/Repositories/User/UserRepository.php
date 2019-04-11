<?php 
namespace App\Repositories\User;
use App\Models\User;
use App\Models\UserBooking;
use DB;
class UserRepository implements UserInterface
{
    private $model;
    public function __construct(User $model){
        $this->model = $model;
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
  
    public function findUserbyEmail(array $input){
        return $this->model->where($input)
                    ->select('email', 'first_name', 'last_name', 'id', 'password', 'access_token', 'email_verified_at',
                    'registration_step')
                    ->first();
    }
 
    public function updateAccessToken(int $id, array $attributes){
        return $this->model->whereId($id)->update($attributes);
    }

    public function findUserBySocialIdAndEmail($social_id,$email){
        return $this->model->where('social_id','=',$social_id)
        ->orWhere('email','=',$email)
        ->first();
    }
    public function findUserByAuthKe(string $auth_key){
        return $this->model->where('authroization_key','=',$auth_key)->first();
    }
    
    public function findNotBookedUser($user_id){
        $current_week= currentWeek();
        return $this->model
            ->select(DB::raw('users.name,users.id,users.email,users.social_image'),
                DB::raw('(select count(user_id) from  user_bookings 
                where user_id=users.id and booking_date BETWEEN '. $current_week[0].' AND '.$current_week[1].')
                    as total_booked_slots'))
            ->where('id','!=',$user_id)
            ->groupBy(DB::raw('users.name,users.id,users.email'))
            // ->having(DB::raw('(select count(user_id) from 
            // user_bookings where user_id=users.id and booking_date BETWEEN '. $current_week[0].' AND '.$current_week[1].')'),'<',2)
            ->get();
    }

}