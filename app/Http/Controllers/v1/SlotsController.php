<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\v1\ApiController;
use App\Repositories\Slot\SlotRepository;
use Illuminate\Support\Facades\Validator;

class SlotsController extends ApiController
{
    private $slot;
    private $current_time;
    public function __construct(SlotRepository $slot){
        $this->slot = $slot;
        $this->current_time=time();
    }
    
    public function view(int $game_id,$date=''){
        if(strlen($date)==0){
            $date=$this->current_time;
        }
        $data=$this->slot->findByDateAndGame($game_id,$date);
        return $this->success($data,'Available Slots List');
    }

    public function store(){
        //todo
    }   
    
    public function update(){
        //todo
    }

    public function fakeAddData(){
        $data=[
            [
                'to' => '11:00',
                'from' => '11:15'
            ],
            [
                'to' => '11:15',
                'from' => '11:30'
            ],
            [
                'to' => '13:00',
                'from' => '13:15'
            ],
            [
                'to' => '13:15',
                'from' => '13:30'
            ],
            [
                'to' => '13:30',
                'from' => '13:45'
            ],
            [
                'to' => '13:45',
                'from' => '14:00'
            ],
            [
                'to' => '14:00',
                'from' => '14:15'
            ],
            [
                'to' => '14:15',
                'from' => '14:30'
            ],
            [
                'to' => '18:30',
                'from' => '18:45'
            ],
            [
                'to' => '18:45',
                'from' => '19:00'
            ],
            [
                'to' => '19:00',
                'from' => '19:15'
            ],
            [
                'to' => '19:15',
                'from' => '19:30'
            ],
        ];
        $this->slot->add($data);
        return 1;
    }


}
