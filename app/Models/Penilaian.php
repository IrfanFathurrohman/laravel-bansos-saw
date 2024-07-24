<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'values'; // Nama tabel database

    protected $fillable = [
        'bansos_id',
        'kriteria_id',
        'keterangan',
        'bobot',
    ];

    public function bansos()
    {
        return $this->belongsTo(Bansos::class, 'bansos_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
}
