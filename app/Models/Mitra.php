<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;
    protected $table = 'mitra';

    protected $fillable = [
        'nama_mitra',
        'jml_kuota',
        'kriteria',
        'jurusan',
        'lokasi',
        'fasilitas',
        'tgl_mulai',
        'tgl_selesai',
    ];
}
