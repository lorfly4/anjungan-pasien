<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registrasi extends Model
{
    use HasFactory;
    
    protected $table = 'riwayat_antrians';
    protected $fillable = [
        'no_rm',
        'no_antrian',
        'tujuan',
        'status',
        'tanggal antrian',
,
    ];
    protected $primaryKey = 'id';

    
    public function pasien_umum()
    {
        return $this->belongsTo(pasien_umum::class, 'no_rm', 'no_rm');
    }
    
    public function pasien_bpjs()
    {
        return $this->belongsTo(pasien_bpjs::class, 'no_rm', 'no_rm');
    }
}
