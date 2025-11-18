<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class user_detail extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userDetails = [
    [
        'user_id' => 1, // Mengacu pada user_id 1 di user_table (misalnya: admin)
        'user_name' => 'Fahmi Adi',
        'address' => 'Jl. Merdeka No. 12, Jakarta',
        'user_phone' => '081211223344',
        'user_status' => 'Aktif',
    ],
    [
        'user_id' => 2, // Mengacu pada user_id 2 di user_table (misalnya: user.satu)
        'user_name' => 'Rina Susanti',
        'address' => 'Komplek Permata Indah Blok A/5, Bandung',
        'user_phone' => '087755443322',
        'user_status' => 'Tidak Aktif',
    ],
    [
        'user_id' => 3, // Mengacu pada user_id 3 di user_table (misalnya: user.dua)
        'user_name' => 'Lukman Hakim',
        'address' => 'Perumahan Sejahtera Kav. 8, Surabaya',
        'user_phone' => '085899887766',
        'user_status' => 'Aktif',
    ],
    [
        'user_id' => 4, // Mengacu pada user_id 4 di user_table (misalnya: user.tiga)
        'user_name' => 'Dewi Puspita',
        'address' => 'Griya Makmur No. 45, Semarang',
        'user_phone' => '089644332211',
        'user_status' => 'Aktif',
    ],
    [
        'user_id' => 5, // Mengacu pada user_id 5 di user_table (misalnya: user.empat)
        'user_name' => 'Taufik Hidayat',
        'address' => 'Jalan Kenanga Raya No. 10, Yogyakarta',
        'user_phone' => '082166554433',
        'user_status' => 'Blokir',
    ],
];

// Masukkan data ke dalam tabel 'user_detail_table'
DB::table('user_detail_table')->insert($userDetails);
    }
}
