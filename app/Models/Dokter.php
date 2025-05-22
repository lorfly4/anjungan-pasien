<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $fillable = [
        'id_dokter',
        'nama_dokter',
        'foto_dokter',
        'id_poli',
    ];

    protected $primaryKey = 'id_dokter'; // <-- tambahkan ini jika bukan 'id'

    protected $keyType = 'string'; // Sesuaikan dengan tipe data primary key tabel poli



    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli', 'id_poli');
    }

}
