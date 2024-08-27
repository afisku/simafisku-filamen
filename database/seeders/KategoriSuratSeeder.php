<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriSurat = [
            ['kode_kategori' => 'ST', 'kategori' => 'SURAT TUGAS'],
            ['kode_kategori' => 'SR', 'kategori' => 'SURAT REKOMENDASI'],
            ['kode_kategori' => 'P', 'kategori' => 'PEMBERITAHUAN'],
            ['kode_kategori' => 'U', 'kategori' => 'SURAT UNDANGAN'],
            ['kode_kategori' => 'SP', 'kategori' => 'SURAT PERINGATAN'],
            ['kode_kategori' => 'SKet', 'kategori' => 'SURAT KETERANGAN'],
            ['kode_kategori' => 'SPPD', 'kategori' => 'SURAT PERINTAH PERJALANAN TUGAS'],
            ['kode_kategori' => 'SM', 'kategori' => 'SURAT MANDAT (KEWENANGAN)'],
            ['kode_kategori' => 'T', 'kategori' => 'SURAT TAGIHAN'],
            ['kode_kategori' => 'PH', 'kategori' => 'SURAT PERMOHONAN'],
            ['kode_kategori' => 'PJ', 'kategori' => 'SURAT PERJANJIAN'],
            ['kode_kategori' => 'SKR', 'kategori' => 'SURAT SKORSING'],
            ['kode_kategori' => 'PG', 'kategori' => 'SURAT PANGGILAN ORANG TUA'],
            ['kode_kategori' => 'SPK', 'kategori' => 'SURAT PERJANJIAN KERJA'],
            ['kode_kategori' => 'SPT', 'kategori' => 'SURAT PENGANTAR'],
            ['kode_kategori' => 'SPn', 'kategori' => 'SURAT PINDAH'],
            ['kode_kategori' => 'OP', 'kategori' => 'ORDER PEMBELIAN'],
            ['kode_kategori' => 'SK', 'kategori' => 'SURAT KEPUTUSAN'],
        ];

        DB::table('kategori_surat')->insert($kategoriSurat);
    }
}
