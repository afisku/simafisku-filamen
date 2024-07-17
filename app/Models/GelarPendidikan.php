<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GelarPendidikan extends Model
{
    use HasFactory;

    protected $table = 'gelar_pendidikan';

    protected $fillable = [
        'nama_gelar_pendidikan',
    ];
}
