<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgamaOrtu extends Model
{
    use HasFactory;
    protected $table = 'agama_ortu';
    
    protected $fillable = [
        'kode',
        'agama'
    ];
}
