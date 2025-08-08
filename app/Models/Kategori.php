<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['id_kategoris', 'kategoris'];

    protected $table = 'kategoris'; // Sesuaikan dengan nama tabel sebenarnya

    public $incrementing = false; // Sesuaikan dengan primary key tabel poli

    protected $keyType = 'string'; // Sesuaikan dengan tipe data primary key tabel poli

    protected $primaryKey = 'id_kategoris'; // <-- tambahkan ini jika bukan 'id'
}
