<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\event;
use Database\Seeders\event_detail;
use Database\Seeders\participant;
use Database\Seeders\registered;
use Database\Seeders\role;
use Database\Seeders\session_table;
use Database\Seeders\user_detail;
use Database\Seeders\user_table;



class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
        event::class,
        session_table::class,      // Contoh: Memanggil seeder peran
        registered::class,     // Contoh: Memanggil seeder acara
        participant::class,     // Contoh: Memanggil seeder acara
        role::class,      // Contoh: Memanggil seeder pengguna
        user_table::class,     // Contoh: Memanggil seeder acara
        user_detail::class,     // Contoh: Memanggil seeder acara
        event_detail::class,     // Contoh: Memanggil seeder acara
        // Pastikan semua seeder yang Anda buat ada di sini
    ]);
    }
}
