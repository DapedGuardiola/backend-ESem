<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class event extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'event_name' => true, // Contoh: True
                'event_status' => 'Ended',
            ],
            [
                'event_name' => false, // Contoh: False
                'event_status' => 'Ended',
            ],
            [
                'event_name' => true,
                'event_status' => 'Ended',
            ],
            [
                'event_name' => false,
                'event_status' => 'Canceled',
            ],
            [
                'event_name' => true,
                'event_status' => 'Ongoing',
            ],
        ];

        // Masukkan data ke dalam tabel 'event_table'
        DB::table('event_table')->insert($events);
    }
}
