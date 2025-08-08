<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pasien_bpjs extends Model
{
    use HasFactory;
protected $table = 'pasien_bpjs';

protected $primaryKey = 'id_pasien';

protected $fillable = [
    'no_rm',
    'no_bpjs',
    'nama_lengkap',
    'nik',
    'jenis_kelamin',
    'tempat_lahir',
    'tanggal_lahir',
    'alamat',
    'no_hp',
    'email',
    'tanggal_daftar',
    'status_aktif',
];

protected $casts = [
    'tanggal_lahir' => 'date',
    'tanggal_daftar' => 'date',
    'status_aktif' => 'boolean',
];

}
