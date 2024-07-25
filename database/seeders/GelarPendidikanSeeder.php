<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GelarPendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gelar_pendidikan')->insert([
            ['nama_gelar_pendidikan' => 'Sarjana Pendidikan (S.Pd.)'],
            ['nama_gelar_pendidikan' => 'Sarjana Teknik (S.T.)'],
            ['nama_gelar_pendidikan' => 'Sarjana Ekonomi (S.E.)'],
            ['nama_gelar_pendidikan' => 'Sarjana Hukum (S.H.)'],
            ['nama_gelar_pendidikan' => 'Sarjana Ilmu Komputer (S.Kom.)'],
            ['nama_gelar_pendidikan' => 'Sarjana Seni (S.Sn.)'],
            ['nama_gelar_pendidikan' => 'Sarjana Pertanian (S.P.)'],
            ['nama_gelar_pendidikan' => 'Sarjana Kesehatan Masyarakat (S.KM.)'],
            ['nama_gelar_pendidikan' => 'Sarjana Psikologi (S.Psi.)'],
            ['nama_gelar_pendidikan' => 'Sarjana Sains (S.Si.)'],
            ['nama_gelar_pendidikan' => 'Sarjana Kedokteran (dr.)'],
            ['nama_gelar_pendidikan' => 'Sarjana Farmasi (S.Farm.)'],
            ['nama_gelar_pendidikan' => 'Sarjana Ilmu Komunikasi (S.I.Kom.)'],
            ['nama_gelar_pendidikan' => 'Magister Manajemen (M.M.)'],
            ['nama_gelar_pendidikan' => 'Magister Hukum (M.H.)'],
            ['nama_gelar_pendidikan' => 'Magister Teknik (M.T.)'],
            ['nama_gelar_pendidikan' => 'Magister Ilmu Komputer (M.Kom.)'],
            ['nama_gelar_pendidikan' => 'Magister Pendidikan (M.Pd.)'],
            ['nama_gelar_pendidikan' => 'Magister Sains (M.Si.)'],
            ['nama_gelar_pendidikan' => 'Magister Kesehatan (M.Kes.)'],
            ['nama_gelar_pendidikan' => 'Doktor (Dr.)'],
            ['nama_gelar_pendidikan' => 'Diploma 1 (D1)'],
            ['nama_gelar_pendidikan' => 'Diploma 2 (D2)'],
            ['nama_gelar_pendidikan' => 'Diploma 3 (D3)'],
            ['nama_gelar_pendidikan' => 'Diploma 4 (D4) / Sarjana Terapan'],
        ]);
    }
}
