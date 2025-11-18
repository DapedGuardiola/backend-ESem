<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class role extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
    [
        'role_type_name' => 'Producer',
    ],
    [
        'role_type_name' => 'Committee',
    ],
    [
        'role_type_name' => 'Committee',
    ],
    [
        'role_type_name' => 'Ticketing',
    ],
    [
        'role_type_name' => 'Attendance',
    ],
];

// Masukkan data ke dalam tabel 'role_table'
DB::table('role_table')->insert($roles);
    }
}
