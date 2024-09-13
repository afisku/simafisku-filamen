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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('asal_sekolah')->nullable();
            $table->string('nspn')->nullable();
            $table->string('nm_siswa')->nullable();
            $table->string('jk')->nullable();
            $table->string('nisn')->nullable();
            $table->string('nis')->nullable();
            $table->string('nik')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->unsignedBigInteger('agama_id')->nullable();
            $table->string('provinsi_asal')->nullable();
            $table->string('kabkota_asal')->nullable();
            $table->string('kecamatan_asal')->nullable();
            $table->string('desalurah_asal')->nullable();
            $table->text('alamat_asal')->nullable();
            $table->string('rt_asal')->nullable();
            $table->string('rw_asal')->nullable();
            $table->string('kodepos_asal')->nullable();
            $table->unsignedBigInteger('transportasi_id')->nullable();
            $table->boolean('yatim_piatu')->nullable();
            $table->text('penyakit')->nullable();
            $table->unsignedBigInteger('jarak_rumah_id')->nullable();
            $table->integer('jumlah_saudara')->nullable();
            $table->integer('anak_ke')->nullable();
            $table->integer('dari_bersaudara')->nullable();
            $table->string('foto')->nullable();
            $table->string('doc_mutasi')->nullable();
            $table->unsignedBigInteger('status_siswa_id')->nullable();
            $table->unsignedBigInteger('tahun_ajaran_id')->nullable();

            $table->string('nm_ayah')->nullable();
            $table->string('nik_ayah')->nullable();
            $table->integer('tahun_lahir_ayah')->nullable();
            $table->unsignedBigInteger('pendidikan_ayah_id')->nullable();
            $table->unsignedBigInteger('pekerjaan_ayah_id')->nullable();
            $table->unsignedBigInteger('penghasilan_ayah_id')->nullable();
            $table->string('nohp_ayah')->nullable();
            $table->string('nm_ibu')->nullable();
            $table->string('nik_ibu')->nullable();
            $table->integer('tahun_lahir_ibu')->nullable();
            $table->unsignedBigInteger('pendidikan_ibu_id')->nullable();
            $table->unsignedBigInteger('pekerjaan_ibu_id')->nullable();
            $table->unsignedBigInteger('penghasilan_ibu_id')->nullable();
            $table->string('nohp_ibu')->nullable();

            $table->string('nm_wali')->nullable();
            $table->string('nik_wali')->nullable();
            $table->integer('tahun_lahir_wali')->nullable();
            $table->unsignedBigInteger('pendidikan_wali_id')->nullable();
            $table->unsignedBigInteger('pekerjaan_wali_id')->nullable();
            $table->unsignedBigInteger('penghasilan_wali_id')->nullable();
            $table->string('nohp_wali')->nullable();
            $table->timestamps();

            $table->foreign('status_siswa_id')->references('id')->on('status_siswa')->onDelete('cascade');
            $table->foreign('tahun_ajaran_id')->references('id')->on('tahun_ajaran')->onDelete('cascade');
            $table->foreign('transportasi_id')->references('id')->on('transportasi')->onDelete('cascade');
            $table->foreign('jarak_rumah_id')->references('id')->on('jarak_rumah')->onDelete('cascade');
            $table->foreign('agama_id')->references('id')->on('agama_ortu')->onDelete('cascade');
            $table->foreign('pendidikan_ayah_id')->references('id')->on('pendidikan_ortu')->onDelete('cascade');
            $table->foreign('pendidikan_ibu_id')->references('id')->on('pendidikan_ortu')->onDelete('cascade');
            $table->foreign('pekerjaan_ayah_id')->references('id')->on('pekerjaan_ortu')->onDelete('cascade');
            $table->foreign('pekerjaan_ibu_id')->references('id')->on('pekerjaan_ortu')->onDelete('cascade');
            $table->foreign('penghasilan_ayah_id')->references('id')->on('penghasilan_ortu')->onDelete('cascade');
            $table->foreign('penghasilan_ibu_id')->references('id')->on('penghasilan_ortu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
