<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TampilanRS extends Model
{
    use HasFactory;

    // If the table name is not the plural form of the model name, specify the table
    protected $table = 'tampilan_rs';

    // Specify which fields are mass assignable
    protected $fillable = [
        'nama_rs',
        'image',
    ];

    // If you're using Laravel's automatic timestamping feature, you don't need to manually manage 'created_at' and 'updated_at'
    public $timestamps = true;

    // Optionally, if you don't want 'id' to auto-increment, you can turn it off (but it's rare)
    // public $incrementing = false;
}
