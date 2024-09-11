<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenghasilanOrtu extends Model
{
    use HasFactory;

    protected $table = 'penghasilan_ortu';
    
    protected $fillable = [
        'kode',
        'penghasilan',
    ];
}
