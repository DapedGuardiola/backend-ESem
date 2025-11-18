<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class registered extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registrations = [
            [
                'event_id' => 1,
                'registered_name' => 'Ahmad Fauzi',
                'registered_email' => 'ahmad.fauzi@example.com',
                'registered_phone' => '081100011122',
                'payment_status' => true, // Sudah Bayar
            ],
            [
                'event_id' => 1,
                'registered_name' => 'Bunga Citra',
                'registered_email' => 'bunga.c@example.com',
                'registered_phone' => '087799988877',
                'payment_status' => false, // Belum Bayar
            ],
            [
                'event_id' => 2,
                'registered_name' => 'Cahya Purnama',
                'registered_email' => 'cahya.p@example.com',
                'registered_phone' => '085811122233',
                'payment_status' => true, // Sudah Bayar
            ],
            [
                'event_id' => 2,
                'registered_name' => 'Dian Kusuma',
                'registered_email' => 'dian.k@example.com',
                'registered_phone' => '082144455566',
                'payment_status' => true, // Sudah Bayar
            ],
            [
                'event_id' => 3,
                'registered_name' => 'Eka Saputra',
                'registered_email' => 'eka.s@example.com',
                'registered_phone' => '089677766655',
                'payment_status' => false, // Belum Bayar
            ],
            [
                'event_id' => 3,
                'registered_name' => 'Fani Amelia',
                'registered_email' => 'fani.a@example.com',
                'registered_phone' => '081322211100',
                'payment_status' => true, // Sudah Bayar
            ],
            [
                'event_id' => 1,
                'registered_name' => 'Gerry Wijaya',
                'registered_email' => 'gerry.w@example.com',
                'registered_phone' => '085733322211',
                'payment_status' => false, // Belum Bayar
            ],
            [
                'event_id' => 2,
                'registered_name' => 'Hana Kartika',
                'registered_email' => 'hana.k@example.com',
                'registered_phone' => '087855544433',
                'payment_status' => true, // Sudah Bayar
            ],
            [
                'event_id' => 3,
                'registered_name' => 'Irfan Junaidi',
                'registered_email' => 'irfan.j@example.com',
                'registered_phone' => '089611199988',
                'payment_status' => true, // Sudah Bayar
            ],
            [
                'event_id' => 1,
                'registered_name' => 'Julieta Bella',
                'registered_email' => 'julieta.b@example.com',
                'registered_phone' => '081288877766',
                'payment_status' => false, // Belum Bayar
            ],
        ];

        // Masukkan data ke dalam tabel 'registered_table'
        DB::table('registered_table')->insert($registrations);
    }
}
