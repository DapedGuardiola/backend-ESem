<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class event_detail extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventDetails = [
            [
                'event_id' => 1,
                'event_name' => 'Webinar Desain Grafis Dasar',
                'total_participant' => 120,
                'date' => '2025-12-01 10:00:00',
                'event_handler' => 1, // User ID 1 (Admin/Handler)
                'cost' => 500000,
                'total_income' => 0, // Karena paid_status false
                'paid_status' => false, // Gratis
            ],
            [
                'event_id' => 2,
                'event_name' => 'Konferensi Teknologi Blockchain 2026',
                'total_participant' => 85,
                'date' => '2025-12-15 09:30:00',
                'event_handler' => 2, // User ID 2
                'cost' => 15000000,
                'total_income' => 42500000,
                'paid_status' => true, // Berbayar
            ],
            [
                'event_id' => 3,
                'event_name' => 'Workshop Pengembangan API Laravel',
                'total_participant' => 45,
                'date' => '2026-01-05 13:00:00',
                'event_handler' => 1, // User ID 1
                'cost' => 5000000,
                'total_income' => 12000000,
                'paid_status' => true, // Berbayar
            ],
            [
                'event_id' => 4,
                'event_name' => 'Sesi Talkshow Karir Digital',
                'total_participant' => 200,
                'date' => '2026-01-20 18:30:00',
                'event_handler' => 3, // User ID 3
                'cost' => 2000000,
                'total_income' => 0,
                'paid_status' => false, // Gratis
            ],
            [
                'event_id' => 5,
                'event_name' => 'Pelatihan Keamanan Jaringan Tingkat Lanjut',
                'total_participant' => 30,
                'date' => '2026-02-10 11:00:00',
                'event_handler' => 4, // User ID 4
                'cost' => 8000000,
                'total_income' => 18000000,
                'paid_status' => true, // Berbayar
            ],
        ];

        // Masukkan data ke dalam tabel 'event_detail_table'
        DB::table('event_detail_table')->insert($eventDetails);
    }
}
