<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuTempuh extends Model
{
    use HasFactory;

    protected $table = 'waktu_tempuh';

    protected $fillable = [
        'kode',
        'waktu'
    ];
}
