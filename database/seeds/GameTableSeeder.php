<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class GameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        DB::statement('TRUNCATE games CASCADE');
        DB::table('games')->insert([
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
        ]);     
    }
}