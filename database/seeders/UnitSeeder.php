<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('unit')->insert([
            ['kode_unit' => 'TKIT','nama_unit' => "TK IT AL-FITYAN KUBU RAYA"],
            ['kode_unit' => 'SDIT','nama_unit' => "SD IT AL-FITYAN KUBU RAYA"],
            ['kode_unit' => 'SMPIT','nama_unit' => "SMP IT AL-FITYAN KUBU RAYA"],
            ['kode_unit' => 'SMAIT','nama_unit' => "SMA IT AL-FITYAN KUBU RAYA"],
        ]);
    }
}
