<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PosisiKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posisi_kerja')->insert([
            ['nama_posisi_kerja' => 'Software Engineer'],
            ['nama_posisi_kerja' => 'Data Analyst'],
            ['nama_posisi_kerja' => 'Product Manager'],
            ['nama_posisi_kerja' => 'UX Designer'],
            ['nama_posisi_kerja' => 'System Administrator'],
            ['nama_posisi_kerja' => 'Quality Assurance'],
            ['nama_posisi_kerja' => 'Business Analyst'],
            ['nama_posisi_kerja' => 'IT Support'],
            ['nama_posisi_kerja' => 'Network Engineer'],
            ['nama_posisi_kerja' => 'Database Administrator'],
        ]);
    }
}
