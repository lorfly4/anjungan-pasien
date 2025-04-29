<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pasien_umum extends Model
{
    use HasFactory;
    
    protected $table = 'pasien_umum';
    protected $guarded = 'id_pasien';
    protected $fillable = [
        'no_rm',
        'nama_lengkap',
        'nik',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'email',
        'tanggal_daftar',
        'status_aktif'
    ];
    public $timestamps = false;
}
