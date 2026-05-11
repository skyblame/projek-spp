<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Petugas extends Authenticatable
{
    use Notifiable;

    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas'; // HARUS SAMA DENGAN DI DATABASE
    
    // Matikan auto-increment kalau di database id_petugas bukan AI, 
    // tapi kalau AI, biarkan true.
    public $incrementing = true; 

    protected $fillable = [
        'username', 'password', 'nama_petugas', 'level',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // Fungsi tambahan biar Laravel gak rewel nyari kolom 'id'
    public function getAuthIdentifierName()
    {
        return 'id_petugas';
    }
}