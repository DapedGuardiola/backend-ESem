<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class user_table extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
    [
        'role_id' => 1, // Penyelenggara
        'email' => 'leader.admin@example.com',
        'password' => Hash::make('password1'), 
    ],
    [
        'role_id' => 2, // Manager Acara
        'email' => 'user.satu@example.com',
        'password' => Hash::make('password2'), 
    ],
    [
        'role_id' => 3, // Panitia
        'email' => 'user.dua@example.com',
        'password' => Hash::make('password3'), 
    ],
    [
        'role_id' => 1, // Manager Acara
        'email' => 'user.empat@example.com',
        'password' => Hash::make('password4'), 
    ],
    [
        'role_id' => 2, // Panitia
        'email' => 'user.lima@example.com',
        'password' => Hash::make('password5'), 
    ],
];

// Masukkan data ke dalam tabel 'user_table'
DB::table('user_table')->insert($users);
    }
}
