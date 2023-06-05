<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'prov',
        'kab',
        'kec',
        'desa',
        'sts'
    ];
}
