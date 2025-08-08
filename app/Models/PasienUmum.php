<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasienUmum extends Model
{
    protected $table = 'pasien_umum';

    protected $fillable = [
        'no_rm',
        'nama_lengkap',
        'nik',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'nomor_hp',
        'email',
        'tanggal_daftar',
        'status_aktif',
    ];

    protected $primaryKey = 'id_pasien';
    
    public $timestamps = false;

}
