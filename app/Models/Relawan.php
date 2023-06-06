<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'name',
        'jenis_kelamin',
        'tmp_lahir',
        'tgl_lahir',
        'organisasi',
        'no_hp',
        'sts'
    ];
}
