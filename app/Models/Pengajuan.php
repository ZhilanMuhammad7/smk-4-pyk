<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table='pengajuans';
    protected $fillable=
    [
        "name",
        'user_id',
        "jurusan",
        "tempat_magang",
        "tgl_mulai",
        "tgl_selesai",
        "gambar",
        "status",
        "ulasan"

    ];
    protected $primaryKey = 'id';
}
