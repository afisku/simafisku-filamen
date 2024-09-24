<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class statusSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status_siswa')->insert([
            ['status' => 'Aktif'],
            ['status' => 'Mutasi Masuk'],
            ['status' => 'Mutasi Keluar'],
            ['status' => 'DO'],
            ['status' => 'Cuti'],
            ['status' => 'Lulus'],
            ['status' => 'Mengundurkan Diri'],
        ]);
    }
}
