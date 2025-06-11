<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LimitasiBpjs extends Model
{
    protected $table = 'limitasi_bpjs';

    protected $primaryKey = 'id_limitasi_bpjs';

    protected $fillable = [
        'limitasi',
    ];
    public $timestamps = true;
}
