<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalDokter extends Model
{
    protected $table = 'jadwal_dokters';

    protected $primaryKey = 'id_jadwal_dokter';

    protected $fillable = [
        'id_dokter',
        'jam_mulai',
        'jam_selesai',
        'hari',
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }

    
}

