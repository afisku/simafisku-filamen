<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatTinggal extends Model
{
    use HasFactory;

    protected $table = 'tempat_tinggal';

    protected $fillable = [
        'kode',
        'tempat_tinggal'
    ];
}
