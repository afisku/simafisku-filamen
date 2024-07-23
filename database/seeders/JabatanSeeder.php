<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jabatan')->insert([
            ['nama_jabatan' => 'Manager'],
            ['nama_jabatan' => 'Staff'],
            ['nama_jabatan' => 'Supervisor'],
            ['nama_jabatan' => 'Direktur'],
            ['nama_jabatan' => 'Kepala Divisi'],
            ['nama_jabatan' => 'Asisten Manager'],
        ]);
    }
}
