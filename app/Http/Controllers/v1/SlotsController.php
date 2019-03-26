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

    }   
    
    public function update(){

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
                'to' => '01:00',
                'from' => '01:15'
            ],
            [
                'to' => '01:15',
                'from' => '01:30'
            ],
            [
                'to' => '01:30',
                'from' => '01:45'
            ],
            [
                'to' => '01:45',
                'from' => '02:00'
            ],
            [
                'to' => '02:00',
                'from' => '02:15'
            ],
            [
                'to' => '02:15',
                'from' => '02:30'
            ],
            [
                'to' => '06:30',
                'from' => '06:45'
            ],
            [
                'to' => '06:45',
                'from' => '07:00'
            ],
            [
                'to' => '07:00',
                'from' => '07:15'
            ],
            [
                'to' => '07:15',
                'from' => '07:30'
            ],
        ];
        $this->slot->add($data);
        return 1;
    }


}
