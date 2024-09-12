<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JarakRumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jarak_rumah')->insert([
            ['kode' => 'A', 'jarak' => '0 s.d. 1 Km'],
            ['kode' => 'B', 'jarak' => '1 s.d. 3 Km'],
            ['kode' => 'C', 'jarak' => '3 s.d. 5 Km'],
            ['kode' => 'D', 'jarak' => '5 s.d. 10 Km'],
            ['kode' => 'E', 'jarak' => 'Lebih dari 10 Km'],
        ]);
    }
}
