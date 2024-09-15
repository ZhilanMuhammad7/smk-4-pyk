<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;
    protected $table = 'ulasans';
    protected $fillable =
    [
        "name",
        'user_id',
        "tempat_magang",
        'bidang_kerja',
        "jurusan",
        "ulasan"
    ];
    protected $primaryKey = 'id';
}
