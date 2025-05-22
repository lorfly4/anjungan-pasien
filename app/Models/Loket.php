<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loket extends Model
{
    protected $fillable = ['id_lokets', 'nama_lokets', 'jenis_berobat', 'keterangan', 'id_dokter', 'id_poli', 'id_kategoris', 'created_at', 'updated_at', 'status'];

    protected $table = 'lokets'; // Sesuaikan dengan nama tabel sebenarnya

    public $incrementing = false; // Sesuaikan dengan primary key tabel poli

    protected $keyType = 'string'; // Sesuaikan dengan tipe data primary key tabel poli

    protected $primaryKey = 'id_lokets'; // <-- tambahkan ini jika bukan 'id'
}
