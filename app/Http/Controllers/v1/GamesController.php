<?php

namespace App\Http\Controllers\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\v1\ApiController;
use App\Repositories\Game\GameRepository;
use Illuminate\Support\Facades\Validator;

class GamesController extends ApiController
{
    private $game;
    public function __construct(GameRepository $game){
        $this->game = $game;
    }

    public function get(){
        $data=$this->game->findAll();
        return $this->success($data,'Avaiable Game listing');
    }

    public function  addFakeData(){
        $data=[
            [
                'name' => 'Chess',
                'total_player_play' => 2,
                'total_games' => 2,
                'min' => 2,
            ],
            [
                'name' => 'Carrom Board',
                'total_player_play' => 4,
                'total_games' => 2,
                'min' => 2,
            ],
            [
                'name' => 'Table Tennis',
                'total_player_play' => 2,
                'total_games' => 1,
                'min' => 2,
            ],
            [
                'name' => 'Pool',
                'total_player_play' => 2,
                'total_games' => 1,
                'min' => 2,
            ],
            [
                'name' => 'Table Football',
                'total_player_play' => 4,
                'total_games' => 1,
                'min' => 4,
            ]
        ];
        $this->game->add($data);
        return 1;
    }


}
