<?php 
namespace App\Repositories\Slot;
use App\Models\Slot;
use App\Models\Booking;
use App\Repositories\Slot\SlotInterface;
use DB;
class SlotRepository implements SlotInterface
{
    private $model;
    private $booking;
    public function __construct(Slot $model,Booking $booking){
        $this->model = $model;
        $this->booking= $booking;
    }

    public function create(array $attributes){
        return $this->model->create($attributes);
    }
    public function add(array $attributes){
        return $this->model->insert($attributes);
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

    public function findByDateAndGame(int $game_id , $date){
        $slots = $this->model->select(['id','from','to'])->get()->toArray();
        $booking= $this->booking->with('game')->where('game_id','=',$game_id)->get();
        return $slots;
    }
}