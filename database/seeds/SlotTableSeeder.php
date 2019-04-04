<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SlotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        DB::statement('TRUNCATE slots CASCADE');
        DB::table('slots')->insert([
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
            ]
        ]);     
    }
}