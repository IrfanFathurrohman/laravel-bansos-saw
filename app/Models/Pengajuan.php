<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'bansos_id',
        'kriteria_id',
        'nilai',
    ];

    public function bansos()
    {
        return $this->belongsTo(Bansos::class, 'bansos_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class, 'nik', 'nik');
    }
}
