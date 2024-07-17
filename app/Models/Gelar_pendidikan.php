<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gelar_pendidikan extends Model
{
    use HasFactory;

    protected $table = 'gelar_pendidikan';

    protected $fillable = [
        'gelar_pendidikan',
    ];
}
