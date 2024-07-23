<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ruangan')->insert([
            ['kode_ruangan' => 'R001', 'nama_ruangan' => 'Ruang 1', 'foto' => 'ruang1.jpg'],
            ['kode_ruangan' => 'R002', 'nama_ruangan' => 'Ruang 2', 'foto' => 'ruang2.jpg'],
            ['kode_ruangan' => 'R003', 'nama_ruangan' => 'Ruang 3', 'foto' => 'ruang3.jpg'],
            ['kode_ruangan' => 'R004', 'nama_ruangan' => 'Ruang 4', 'foto' => 'ruang4.jpg'],
            ['kode_ruangan' => 'R005', 'nama_ruangan' => 'Ruang 5', 'foto' => 'ruang5.jpg'],
            ['kode_ruangan' => 'R006', 'nama_ruangan' => 'Ruang 6', 'foto' => 'ruang6.jpg'],
            ['kode_ruangan' => 'R007', 'nama_ruangan' => 'Ruang 7', 'foto' => 'ruang7.jpg'],
            ['kode_ruangan' => 'R008', 'nama_ruangan' => 'Ruang 8', 'foto' => 'ruang8.jpg'],
            ['kode_ruangan' => 'R009', 'nama_ruangan' => 'Ruang 9', 'foto' => 'ruang9.jpg'],
            ['kode_ruangan' => 'R010', 'nama_ruangan' => 'Ruang 10', 'foto' => 'ruang10.jpg'],
        ]);
    }
}
