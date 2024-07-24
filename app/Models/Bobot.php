<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bobot extends Model
{
    use HasFactory;

    protected $fillable = [
        'bansos_id',
        'kriteria_id',
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
