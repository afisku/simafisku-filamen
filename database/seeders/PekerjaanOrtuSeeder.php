<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PekerjaanOrtuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pekerjaan_ortu')->insert([
            ['kode' => 'A', 'pekerjaan' => 'PNS'],
            ['kode' => 'B', 'pekerjaan' => 'TNI/Polri'],
            ['kode' => 'C', 'pekerjaan' => 'Guru/Dosen'],
            ['kode' => 'D', 'pekerjaan' => 'Dokter'],
            ['kode' => 'E', 'pekerjaan' => 'Politikus'],
            ['kode' => 'F', 'pekerjaan' => 'Pegawai Swasta'],
            ['kode' => 'G', 'pekerjaan' => 'Pedagang/Wiraswasta'],
            ['kode' => 'H', 'pekerjaan' => 'Petani/Peternak'],
            ['kode' => 'I', 'pekerjaan' => 'Seni/Lukis/Artis/Sejenisnya'],
            ['kode' => 'J', 'pekerjaan' => 'Buruh'],
            ['kode' => 'K', 'pekerjaan' => 'Dirumah'],
        ]);
    }
}
