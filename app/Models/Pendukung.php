<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendukung extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_relawan',
        'name',
        'no_ktp',
        'no_kk',
        'alamat',
        'keterangan',
        'jenis_kelamin',
        'gambar'
    ];
}
