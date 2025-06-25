<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoketPoli extends Model
{
    protected $table = 'loket_poli';

    protected $fillable = [
        'id_loket', 'id_poli'
    ];

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli', 'id_poli');
    }

    public function loket()
    {
        return $this->belongsTo(Loket::class, 'id_loket', 'id_lokets');
    }
}
