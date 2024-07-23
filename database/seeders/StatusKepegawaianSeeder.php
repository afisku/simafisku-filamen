<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusKepegawaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('status_kepegawaian')->insert([
            ['status' => 'Tetap'],
            ['status' => 'Kontrak'],
            ['status' => 'Magang'],
            ['status' => 'Freelance'],
            ['status' => 'Outsource'],
        ]);
    }
}
