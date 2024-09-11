<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanOrtu extends Model
{
    use HasFactory;

    protected $table = 'pendidikan_ortu';

    protected $fillable = [
        'kode',
        'pendidikan'
    ];
}
