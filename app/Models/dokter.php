<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dokter extends Model
{
    protected $fillable = [
        'id_dokter',
        'nama_dokter',
        'foto_dokter',
        'id_poli',
    ];

    public $table = 'dokters'; // Sesuaikan dengan nama tabel sebenarnya

    protected $primaryKey = 'id_dokter'; // <-- tambahkan ini jika bukan 'id'


    // protected $hidden = [
    //     'password',
    // ];

    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];


public function poli() {
    return $this->belongsTo(\App\Models\poli::class, 'id_poli', 'id_poli');
}

}