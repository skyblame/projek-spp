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
    Schema::create('pembayaran', function (Blueprint $table) {
        $table->id('id_pembayaran'); // Primary key
        $table->unsignedBigInteger('id_petugas'); // Ngambil dari tabel petugas
        $table->string('nisn', 10); // Ngambil dari tabel siswa
        $table->date('tgl_bayar');
        $table->string('bulan_dibayar', 8);
        $table->string('tahun_dibayar', 4);
        $table->unsignedBigInteger('id_spp'); // Ngambil dari tabel spp
        $table->integer('jumlah_bayar');
        $table->timestamps();

        // Menyambungkan relasi (Foreign Key)
        $table->foreign('id_petugas')->references('id_petugas')->on('petugas')->onDelete('cascade');
        $table->foreign('nisn')->references('nisn')->on('siswa')->onDelete('cascade');
        $table->foreign('id_spp')->references('id_spp')->on('spp')->onDelete('cascade');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
