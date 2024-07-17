<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanTerakhir extends Model
{
    use HasFactory;

    protected $table = 'pendidikan_terakhir';

    protected $fillable = [
        'nama_pendidikan_terakhir',
    ];
}
