<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RuanganSeeder::class,
            JabatanSeeder::class,
            StatusKepegawaianSeeder::class,
            PosisiKerjaSeeder::class,
            PendidikanTerakhirSeeder::class,
            UnitSeeder::class,
            KaryawanSeeder::class,
        ]);
    }
}
