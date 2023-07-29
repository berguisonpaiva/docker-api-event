<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'name' => 'Evento de programação backend java',
                'start_date' => '2023-07-29',
                'end_date' => '2023-07-31',
                'status' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Evento de programação backend php',
                'start_date' => '2023-07-29',
                'end_date' => '2023-07-31',
                'status' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Evento de programação frontend',
                'start_date' => '2023-07-29',
                'end_date' => '2023-07-31',
                'status' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Evento de programação frontend em reactjs',
                'start_date' => '2023-08-01',
                'end_date' => '2023-08-01',
                'status' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Evento de programação frontend em nextjs',
                'start_date' => '2023-07-28',
                'end_date' => '2023-07-28',
                'status' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

       
        DB::table('events')->insert($events);
    }
}
