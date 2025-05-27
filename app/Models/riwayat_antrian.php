<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class riwayat_antrian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'riwayat_antrians';
    protected $fillable = ['no_rm', 'tujuan', 'no_antrian', 'tanggal_antrian'];

    public $timestamps = false;

}
