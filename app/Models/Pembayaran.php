<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';
    
    protected $fillable = [
        'id_petugas',
        'nisn',
        'tgl_bayar',
        'bulan_dibayar',
        'tahun_dibayar',
        'id_spp',
        'jumlah_bayar'
    ];

    // Relasi ke tabel Petugas (1 Pembayaran dilayani 1 Petugas)
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id_petugas');
    }

    // Relasi ke tabel Siswa (1 Pembayaran milik 1 Siswa)
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn', 'nisn');
    }

    // Relasi ke tabel SPP (1 Pembayaran berdasarkan 1 tarif SPP)
    public function spp()
    {
        return $this->belongsTo(Spp::class, 'id_spp', 'id_spp');
    }
}