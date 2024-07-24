<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriteria'; 
    protected $fillable = ['bansos_id', 'nama', 'sifat'];

    public function bansos()
    {
        return $this->belongsTo(Bansos::class);
    }
}
