<?php

namespace Database\Seeders;

use App\Models\DataAsalPerolehan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RolesSeeder::class,
            UsersSeeder::class,
            BarangSeeder::class,
            DataAsalPerolehanSeeder::class,
            DataJenisAsetSeeder::class,
            JenisBarangSeeder::class,
            SatuanSeeder::class,
            StatusKonfirmasiSeeder::class,
            StatusPeminjamanSeeder::class,
        ]);
    }
}
