<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            DB::table('karyawan')->insert([
                [
                    'npy' => '05000008',
                    'nama_lengkap' => 'Tia Hafriana, S.Pd.',
                    'jenis_kelamin' => 'P',
                    'tanggal_mulai_bekerja' => '2013-07-01',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000015',
                    'nama_lengkap' => 'Yeni, S.Pd.',
                    'jenis_kelamin' => 'P',
                    'tanggal_mulai_bekerja' => '2013-07-01',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000018',
                    'nama_lengkap' => 'Siti Nurhalisa, S.H.',
                    'jenis_kelamin' => 'P',
                    'tanggal_mulai_bekerja' => '2013-02-01',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000032',
                    'nama_lengkap' => 'Yana Arsila, S.Pd.',
                    'jenis_kelamin' => 'P',
                    'tanggal_mulai_bekerja' => '2013-07-01',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000035',
                    'nama_lengkap' => 'Rasmawati, S.Pd.I.',
                    'jenis_kelamin' => 'P',
                    'tanggal_mulai_bekerja' => '2014-05-21',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000106',
                    'nama_lengkap' => 'Yuyun Rusmita, S.Pd.',
                    'jenis_kelamin' => 'P',
                    'tanggal_mulai_bekerja' => '2013-07-01',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000107',
                    'nama_lengkap' => 'Rusnahwati',
                    'jenis_kelamin' => 'P',
                    'tanggal_mulai_bekerja' => '2013-09-01',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000115',
                    'nama_lengkap' => 'Ardi, S.Pd.Gr.',
                    'jenis_kelamin' => 'L',
                    'tanggal_mulai_bekerja' => '2014-01-20',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000201',
                    'nama_lengkap' => 'Heru Purwanto, S.Pd.',
                    'jenis_kelamin' => 'L',
                    'tanggal_mulai_bekerja' => '2014-05-21',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000205',
                    'nama_lengkap' => 'Rika Dwi Anggraini, S.Pd.',
                    'jenis_kelamin' => 'P',
                    'tanggal_mulai_bekerja' => '2015-08-31',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000254',
                    'nama_lengkap' => 'Ibmu Kautsar, S.Pd.I.',
                    'jenis_kelamin' => 'L',
                    'tanggal_mulai_bekerja' => '2017-11-10',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000311',
                    'nama_lengkap' => 'Mihrah Hasan, S.Pd.',
                    'jenis_kelamin' => 'P',
                    'tanggal_mulai_bekerja' => '2013-07-01',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000343',
                    'nama_lengkap' => 'Umi Kalsum, S.Pd.',
                    'jenis_kelamin' => 'P',
                    'tanggal_mulai_bekerja' => '2013-07-01',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000344',
                    'nama_lengkap' => 'Pandu Riyandi, S.Pd.',
                    'jenis_kelamin' => 'L',
                    'tanggal_mulai_bekerja' => '2014-05-21',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000345',
                    'nama_lengkap' => 'Erik Rahmana, S.Pd.',
                    'jenis_kelamin' => 'L',
                    'tanggal_mulai_bekerja' => '2015-08-11',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000346',
                    'nama_lengkap' => 'Nur Hidayatullah, S.Pd.',
                    'jenis_kelamin' => 'L',
                    'tanggal_mulai_bekerja' => '2013-07-01',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000347',
                    'nama_lengkap' => 'Sutrisno, S.Pd.',
                    'jenis_kelamin' => 'L',
                    'tanggal_mulai_bekerja' => '2015-05-21',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000348',
                    'nama_lengkap' => 'Siti Amalia Hidayah, S.Pd.',
                    'jenis_kelamin' => 'P',
                    'tanggal_mulai_bekerja' => '2014-05-21',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000349',
                    'nama_lengkap' => 'Ana Khairunnisa, S.Pd.',
                    'jenis_kelamin' => 'P',
                    'tanggal_mulai_bekerja' => '2016-07-14',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000350',
                    'nama_lengkap' => 'Juli Elmariza, S.Si.',
                    'jenis_kelamin' => 'P',
                    'tanggal_mulai_bekerja' => '2016-07-14',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000352',
                    'nama_lengkap' => 'Wulandari, S.Pd.',
                    'jenis_kelamin' => 'P',
                    'tanggal_mulai_bekerja' => '2019-09-24',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000355',
                    'nama_lengkap' => 'Agus Purwanti, S.Pd.',
                    'jenis_kelamin' => 'P',
                    'tanggal_mulai_bekerja' => '2019-01-16',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000356',
                    'nama_lengkap' => 'Ahmad Awaludin, S.Pd, M.Pd.',
                    'jenis_kelamin' => 'L',
                    'tanggal_mulai_bekerja' => '2019-01-28',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000358',
                    'nama_lengkap' => 'Edi Saputra, A.Md.',
                    'jenis_kelamin' => 'L',
                    'tanggal_mulai_bekerja' => '2019-09-12',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000441',
                    'nama_lengkap' => 'Prettyana, S.Pd',
                    'jenis_kelamin' => 'P',
                    'tanggal_mulai_bekerja' => '2023-06-20',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000468',
                    'nama_lengkap' => 'Nur Jayanti, A.Md.',
                    'jenis_kelamin' => 'P',
                    'tanggal_mulai_bekerja' => '2021-08-09',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000481',
                    'nama_lengkap' => 'M Yudi, A.Md.',
                    'jenis_kelamin' => 'L',
                    'tanggal_mulai_bekerja' => '2022-01-17',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000497',
                    'nama_lengkap' => 'Dian Faqih, S.Pd., Gr.',
                    'jenis_kelamin' => 'P',
                    'tanggal_mulai_bekerja' => '2022-07-12',
                    'unit_id' => 3,
                ],
                [
                    'npy' => '05000551',
                    'nama_lengkap' => 'Faza Andary Qatrunnada, Lc',
                    'jenis_kelamin' => 'P',
                    'tanggal_mulai_bekerja' => '2023-07-04',
                    'unit_id' => 3,
                ],
            ]);
        }
    }
}
