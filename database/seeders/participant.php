<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class participant extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --- Event 1 (Total 5 Data: S1:2, S2:2, S3:1) ---
        $participants = [
            // Registered ID 1 (Event 1): Ikut semua 3 Sesi
            ['event_id' => 1, 'session_id' => 1, 'registered_id' => 1],
            ['event_id' => 1, 'session_id' => 2, 'registered_id' => 1],
            ['event_id' => 1, 'session_id' => 3, 'registered_id' => 1],

            // Registered ID 2 (Event 1): Ikut semua 3 Sesi
            ['event_id' => 1, 'session_id' => 1, 'registered_id' => 2],
            ['event_id' => 1, 'session_id' => 2, 'registered_id' => 2],
            ['event_id' => 1, 'session_id' => 3, 'registered_id' => 2],

            // Registered ID 3 (Event 2): Ikut semua 3 Sesi
            ['event_id' => 2, 'session_id' => 1, 'registered_id' => 3],
            ['event_id' => 2, 'session_id' => 2, 'registered_id' => 3],
            ['event_id' => 2, 'session_id' => 3, 'registered_id' => 3],

            // Registered ID 4 (Event 2): Ikut 3 Sesi
            ['event_id' => 2, 'session_id' => 1, 'registered_id' => 4],
            ['event_id' => 2, 'session_id' => 2, 'registered_id' => 4],
            ['event_id' => 2, 'session_id' => 3, 'registered_id' => 4],

            // Registered ID 5 (Event 3): Ikut 3 Sesi
            ['event_id' => 3, 'session_id' => 1, 'registered_id' => 5],
            ['event_id' => 3, 'session_id' => 2, 'registered_id' => 5],
            ['event_id' => 3, 'session_id' => 3, 'registered_id' => 5],

            // Registered ID 6 (Event 3): Ikut 3 Sesi
            ['event_id' => 3, 'session_id' => 1, 'registered_id' => 6],
            ['event_id' => 3, 'session_id' => 2, 'registered_id' => 6],
            ['event_id' => 3, 'session_id' => 3, 'registered_id' => 6],

            // Tambahan 2 data unik (Membutuhkan Registered ID 7 dan 8)
            ['event_id' => 1, 'session_id' => 1, 'registered_id' => 7], // ID 7 (Event 1)
            ['event_id' => 2, 'session_id' => 1, 'registered_id' => 8], // ID 8 (Event 2)
        ];

        // Masukkan data ke dalam tabel 'participant_table'
        DB::table('participant_table')->insert($participants);
    }
}
