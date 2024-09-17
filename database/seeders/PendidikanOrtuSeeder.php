<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PendidikanOrtuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pendidikan_ortu')->insert([
            ['kode' => 'A', 'pendidikan' => 'Tidak Tamat SD/MI/Paket A'],
            ['kode' => 'B', 'pendidikan' => 'SD/MI/Paket A'],
            ['kode' => 'C', 'pendidikan' => 'SMP/MTs/Paket B'],
            ['kode' => 'D', 'pendidikan' => 'SMA/MA/Paket C'],
            ['kode' => 'E', 'pendidikan' => 'Diploma 1 & 2'],
            ['kode' => 'F', 'pendidikan' => 'Diploma 3 & 4'],
            ['kode' => 'G', 'pendidikan' => 'S.1 (Sarjana)'],
            ['kode' => 'H', 'pendidikan' => 'S.2 (Magister)'],
            ['kode' => 'I', 'pendidikan' => 'S.3 (Doktor)'],
            ['kode' => 'J', 'pendidikan' => 'Lainnya'],
        ]);
    }
}
