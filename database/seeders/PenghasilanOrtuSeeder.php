<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenghasilanOrtuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penghasilan_ortu')->insert([
            ['kode' => 'A', 'penghasilan' => 'Rp. < 5 Ratus /bulan'],
            ['kode' => 'B', 'penghasilan' => 'Rp. 5 Ratus s/d 1 Juta/bulan'],
            ['kode' => 'C', 'penghasilan' => 'Rp. 1 Juta s/d 2 Juta/bulan'],
            ['kode' => 'D', 'penghasilan' => 'Rp. 2 Juta s/d 5 Juta/bulan'],
            ['kode' => 'E', 'penghasilan' => 'Rp 5 Juta s/d 20 Juta'],
            ['kode' => 'F', 'penghasilan' => '> Rp 20 Juta'],
            ['kode' => 'G', 'penghasilan' => 'TIDAK BERPENGHASILAN'],
        ]);
    }
}
