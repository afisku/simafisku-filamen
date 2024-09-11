<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiBelajarDirumah extends Model
{
    use HasFactory;
    protected $table = 'kondisi_belajar';
    
    protected $fillable = [
        'kode',
        'kondisi'
    ];
}
