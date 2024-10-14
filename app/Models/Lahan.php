<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lahan extends Model
{
    use HasFactory;

    protected $fillable = ['petani_id', 'lokasi_lahan', 'luas_lahan', 'tanaman_id'];

    public function petani()
    {
        return $this->belongsTo(Petani::class);
    }

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class);
    }
}

