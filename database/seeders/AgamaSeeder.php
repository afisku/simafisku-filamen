<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AgamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('agama')->insert([
            ['kode' => 'A', 'agama' => 'Islam'],
            ['kode' => 'B', 'agama' => 'Katolik'],
            ['kode' => 'C', 'agama' => 'Protestan'],
            ['kode' => 'D', 'agama' => 'Budha'],
            ['kode' => 'E', 'agama' => 'Hindu'],
            ['kode' => 'F', 'agama' => 'Lainnya'],
            ['kode' => 'G', 'agama' => 'Khonghucu'],
        ]);
    }
}
