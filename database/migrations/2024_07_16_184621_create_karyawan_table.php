<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('npy')->unique();
            $table->string('nama_lengkap');
            $table->string('nik')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('alamat');
            $table->string('nomor_telepon');
            $table->unsignedBigInteger('user_id')->nullable();

            // Data Pekerjaan
            $table->unsignedBigInteger('jabatan_id')->nullable();
            $table->unsignedBigInteger('posisi_kerja_id')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->date('tanggal_mulai_bekerja');
            $table->unsignedBigInteger('status_karyawan_id');

            // Pendidikan
            $table->unsignedBigInteger('pendidikan_terakhir_id')->nullable();
            $table->unsignedBigInteger('gelar_pendidikan_id')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('institusi_pendidikan')->nullable();
            $table->year('tahun_lulus')->nullable();

            // // Pengalaman Kerja
            // $table->text('riwayat_pekerjaan_sebelumnya')->nullable();
            // $table->date('periode_kerja_sebelumnya')->nullable();

            // Data Keluarga
            $table->string('nama_pasangan')->nullable();
            $table->integer('jumlah_anak')->nullable();
            $table->string('kontak_darurat')->nullable();

            // Dokumen Penting
            $table->string('foto_karyawan')->nullable();
            $table->string('scan_ktp')->nullable();
            $table->string('scan_kk')->nullable();
            $table->string('scan_ijazah_terakhir')->nullable();
            $table->string('scan_sertifikat_penghargaan')->nullable();
            $table->string('sertifikat_prestasi')->nullable();
            $table->string('scan_sk_yayasan')->nullable();
            $table->string('scan_sk_mengajar')->nullable();
            

            $table->timestamps();

            // Definisi Foreign Key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('unit')->onDelete('set null');
            $table->foreign('jabatan_id')->references('id')->on('jabatan')->onDelete('set null');
            $table->foreign('pendidikan_terakhir_id')->references('id')->on('pendidikan_terakhir')->onDelete('set null');
            $table->foreign('gelar_pendidikan_id')->references('id')->on('gelar_pendidikan')->onDelete('set null');
            $table->foreign('posisi_kerja_id')->references('id')->on('posisi_kerja')->onDelete('set null');
            $table->foreign('status_karyawan_id')->references('id')->on('status_kepegawaian')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
