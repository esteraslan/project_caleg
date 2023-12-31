<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_kab',
        'id_kec',
        'id_kel',
        'no_rt',
        'no_rw',
        'nm_kp',
        'sts'
    ];
}
