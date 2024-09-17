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
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat')->nullable();
            $table->unsignedBigInteger('kategori_surat_id')->nullable();
            $table->date('tgl_surat_keluar')->nullable();
            $table->string('perihal')->nullable();
            $table->string('tujuan_pengiriman')->nullable();
            $table->string('descripsi')->nullable();
            $table->string('dokumen')->nullable();
            $table->unsignedBigInteger('dibuat_oleh')->nullable();
            $table->unsignedBigInteger('th_ajaran_id');
            $table->timestamps();

            // Foreign key untuk `dibuat_oleh` yang mengacu pada `id` di tabel `users`
            $table->foreign('dibuat_oleh')->references('id')->on('users')->onDelete('set null');
            $table->foreign('th_ajaran_id')->references('id')->on('tahun_ajaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluar');
    }
};
