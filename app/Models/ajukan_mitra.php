<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ajukan_mitra extends Model
{
    use HasFactory;

    protected $table = 'ajukan_mitras';

    protected $fillable = [
        'nama',
        'user_id',
        'mitra_id',
        'jurusan',
        'gambar',
        'status',
        'ulasan',

    ];
    protected $primaryKey = 'id';
    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'mitra_id', 'id');
    }
}
