<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $table='surats';
    protected $fillable=
    [
        "name",
        "user_id",
        "tempat_lahir",
        "tgl_lahir",
        "tgl_mulai_pkl",
        "tgl_selesai_pkl",
        "no_handphone",
        "alamat",
        "tempat_pkl",
        "bidang_kerja",
        "jurusan",
        'status'
    ];
    protected $primaryKey = 'id';
}
