<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sawah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sawah',
        'lokasi_sawah',
        'luas_sawah',
    ];

    public function panens()
    {
        return $this->hasMany(Panen::class);
    }
}
