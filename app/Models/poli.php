<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class poli extends Model
{
    use HasFactory;

    protected $fillable = ['id_poli', 'nama_poli'];

    protected $table = 'poli'; // Sesuaikan dengan nama tabel sebenarnya

    public $incrementing = false; // Sesuaikan dengan primary key tabel poli

    protected $keyType = 'string'; // Sesuaikan dengan tipe data primary key tabel poli

    protected $primaryKey = 'id_poli'; // <-- tambahkan ini jika bukan 'id'

// Model Poli
public function dokter() {
    return $this->hasMany(\App\Models\dokter::class, 'id_poli', 'id_poli');
}
}
