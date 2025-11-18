<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class session_table extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sessions = [
            [
                'session_name' => 'Pembukaan dan Keynote Speaker',
            ],
            [
                'session_name' => 'Core Session',
            ],
            [
                'session_name' => 'Closing Event',
            ],
        ];

        DB::table('session_table')->insert($sessions);
    }
}
