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
                'to' => '12:00',
                'from' => '12:15'
            ],
            [
                'to' => '12:15',
                'from' => '12:30'
            ],
            [
                'to' => '12:30',
                'from' => '12:45'
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
                'to' => '14:30',
                'from' => '14:45'
            ],
            [
                'to' => '14:45',
                'from' => '15:00'
            ],
            [
                'to' => '15:00',
                'from' => '15:15'
            ],
            [
                'to' => '15:15',
                'from' => '15:30'
            ],
            [
                'to' => '15:30',
                'from' => '15:45'
            ],
            [
                'to' => '15:45',
                'from' => '16:00'
            ],
            [
                'to' => '16:00',
                'from' => '16:15'
            ],
            [
                'to' => '16:15',
                'from' => '16:30'
            ],
            [
                'to' => '16:30',
                'from' => '16:45'
            ],
            [
                'to' => '16:45',
                'from' => '17:00'
            ],
            [
                'to' => '17:00',
                'from' => '17:15'
            ],
            [
                'to' => '17:15',
                'from' => '17:30'
            ],
            [
                'to' => '17:30',
                'from' => '17:45'
            ],
            [
                'to' => '17:45',
                'from' => '18:00'
            ],
            [
                'to' => '18:00',
                'from' => '18:15'
            ],
            [
                'to' => '18:15',
                'from' => '18:30'
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