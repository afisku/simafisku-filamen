<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JarakRumah extends Model
{
    use HasFactory;
    protected $table = 'jarak_rumah';
    
    protected $fillable = [
        'kode',
        'jarak'
    ];

}
