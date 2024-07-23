<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PendidikanTerakhirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_pendidikan_terakhir' => 'Tamat SD'],
            ['nama_pendidikan_terakhir' => 'Tamat MI'],
            ['nama_pendidikan_terakhir' => 'Tamat SMP'],
            ['nama_pendidikan_terakhir' => 'Tamat MTs'],
            ['nama_pendidikan_terakhir' => 'Tamat SMA'],
            ['nama_pendidikan_terakhir' => 'Tamat MA'],
            ['nama_pendidikan_terakhir' => 'Tamat SMK'],
            ['nama_pendidikan_terakhir' => 'Ahli Pratama (D1)'],
            ['nama_pendidikan_terakhir' => 'Ahli Muda (D2)'],
            ['nama_pendidikan_terakhir' => 'Ahli Madya (D3)'],
            ['nama_pendidikan_terakhir' => 'Sarjana Terapan (D4)'],
            ['nama_pendidikan_terakhir' => 'Sarjana (S1)'],
            ['nama_pendidikan_terakhir' => 'Magister (S2)'],
            ['nama_pendidikan_terakhir' => 'Doktor (S3)'],
            ['nama_pendidikan_terakhir' => 'Setara SD (Paket A)'],
            ['nama_pendidikan_terakhir' => 'Setara SMP (Paket B)'],
            ['nama_pendidikan_terakhir' => 'Setara SMA (Paket C)'],
        ];

        DB::table('pendidikan_terakhir')->insert($data);
    }
}
