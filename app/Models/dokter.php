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
    return $this->belongsTo(Poli::class, 'id_poli', 'id_poli');
}
// Model Dokter.php
public function jadwal() {
    return $this->hasMany(\App\Models\JadwalDokter::class, 'id_dokter');
}

}