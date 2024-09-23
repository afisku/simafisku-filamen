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
        Schema::create('ortu_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kk')->nullable();
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


            $table->foreign('pendidikan_ayah_id')->references('id')->on('pendidikan_ortu')->onDelete('set null');
            $table->foreign('pendidikan_ibu_id')->references('id')->on('pendidikan_ortu')->onDelete('set null');
            $table->foreign('pekerjaan_ayah_id')->references('id')->on('pekerjaan_ortu')->onDelete('set null');
            $table->foreign('pekerjaan_ibu_id')->references('id')->on('pekerjaan_ortu')->onDelete('set null');
            $table->foreign('penghasilan_ayah_id')->references('id')->on('penghasilan_ortu')->onDelete('set null');
            $table->foreign('penghasilan_ibu_id')->references('id')->on('penghasilan_ortu')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ortu_siswa');
    }
};
