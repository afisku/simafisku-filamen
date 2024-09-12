<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransportasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transportasi')->insert([
            ['kode' => 'A', 'kendaraan' => 'Jalan kaki'],
            ['kode' => 'B', 'kendaraan' => 'Sepeda'],
            ['kode' => 'C', 'kendaraan' => 'Motor'],
            ['kode' => 'D', 'kendaraan' => 'Mobil pribadi'],
            ['kode' => 'E', 'kendaraan' => 'Antar-Jemput'],
            ['kode' => 'F', 'kendaraan' => 'Angkutan umum'],
        ]);
    }
}
