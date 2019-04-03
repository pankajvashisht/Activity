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
            ]
        ]);     
    }
}