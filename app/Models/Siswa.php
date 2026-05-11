<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'nisn';
    public $incrementing = false; // Wajib ditambahin karena NISN itu kita ketik manual, bukan auto-nambah dari database
    protected $keyType = 'string';

    protected $fillable = [
        'nisn',
        'nis',
        'nama',
        'id_kelas',
        'alamat',
        'no_telp',
        'id_spp'
    ];

    // Relasi ke Model Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    // Relasi ke Model SPP
    public function spp()
    {
        return $this->belongsTo(Spp::class, 'id_spp', 'id_spp');
    }
}