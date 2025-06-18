<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatAntrians extends Model
{
    protected $table = 'riwayat_antrians';

    protected $fillable = [
        'id',
        'no_rm',
        'no_antrian',
        'tujuan',
        'tanggal_antrian',
        'id_lokets',
        'nama_pasien',
        'jam',
        'dokter',
        'dipanggil',
    ];

    public $timestamps = true;

    public function loket()
    {
        return $this->belongsTo(\App\Models\Loket::class, 'id_lokets', 'id_lokets');
    }


}
