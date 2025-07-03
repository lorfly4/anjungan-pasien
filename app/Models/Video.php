<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['id','title', 'type', 'path'];

    // protected $timestamps = true;
}
