<?php

namespace App\Imports;

use App\Models\Msiswa;
use App\Models\OrtuSiswa;
use App\Models\StatusSiswa;
use App\Models\PekerjaanOrtu;
use App\Models\PendidikanOrtu;
use App\Models\PenghasilanOrtu;
use Maatwebsite\Excel\Concerns\ToModel; 

class ImportDataSiswa implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Mengambil ID status siswa berdasarkan nama status siswa
        $statusSiswa = StatusSiswa::where('status', $row[6])->first();

        $siswa = Msiswa::create([
            'nis' => $row[0],
            'nisn' => $row[1],
            'nm_siswa' => $row[2],
            'jk' => $this->convertGender($row[3]),
            'tempat_lahir' => $row[4],
            // Pastikan format tanggal benar
            'tgl_lahir' => $this->transformDate($row['tanggal_lahir']),
            'status_siswa_id' => $statusSiswa ? $statusSiswa->id : null,
        ]);

        // Membuat atau mendapatkan data ortu_siswa yang berelasi dengan siswa
        $ortu = OrtuSiswa::create([
            'nm_ayah' => $row[7],
            'nik_ayah' => $row[8],
            'tahun_lahir_ayah' => $row[9],
            'pendidikan_ayah_id' => $this->getPendidikanId($row[10]),
            'pekerjaan_ayah_id' => $this->getPekerjaanId($row[11]),
            'penghasilan_ayah_id' => $this->getPenghasilanId($row[12]),
            'nohp_ayah' => $row[13],
            'nm_ibu' => $row[14],
            'nik_ibu' => $row[15],
            'tahun_lahir_ibu' => $row[16],
            'pendidikan_ibu_id' => $this->getPendidikanId($row[17]),
            'pekerjaan_ibu_id' => $this->getPekerjaanId($row[18]),
            'penghasilan_ibu_id' => $this->getPenghasilanId($row[19]),
            'nohp_ibu' => $row[20],
            'nm_wali' => $row[21],
            'nik_wali' => $row[22],
            'tahun_lahir_wali' => $row[23],
            'pendidikan_wali_id' => $this->getPendidikanId($row[24]),
            'pekerjaan_wali_id' => $row[25],
            'penghasilan_wali_id' => $this->getPenghasilanId($row[26]),
            'nohp_wali' => $row[27],
            'siswa_id' => $siswa->id, // Menyimpan relasi ke siswa
        ]);
        return $siswa;
    }

    private function convertGender($value)
    {
    return strtolower($value) === 'laki-laki' ? 'L' : (strtolower($value) === 'perempuan' ? 'P' : null);
    }

    private function transformDate($value)
    {
        // Memastikan bahwa input tanggal sesuai dengan format yang benar (YYYY-MM-DD)
        try {
            return \Carbon\Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null; // Jika format salah, kosongkan data ini.
        }
    }
    private function getPendidikanId($namaPendidikan)
    {
        $pendidikan = PendidikanOrtu::where('nama_pendidikan_terakhir', $namaPendidikan)->first();
        return $pendidikan ? $pendidikan->id : null;
    }

    // Contoh metode helper untuk mendapatkan ID pekerjaan berdasarkan nama pekerjaan
    private function getPekerjaanId($namaPekerjaan)
    {
        $pekerjaan = PekerjaanOrtu::where('pekerjaan', $namaPekerjaan)->first();
        return $pekerjaan ? $pekerjaan->id : null;
    }

    // Contoh metode helper untuk mendapatkan ID penghasilan berdasarkan rentang penghasilan
    private function getPenghasilanId($namaPenghasilan)
    {
        $penghasilan = PenghasilanOrtu::where('penghasilan', $namaPenghasilan)->first();
        return $penghasilan ? $penghasilan->id : null;
    }
}
