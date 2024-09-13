<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pupuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pupuk',
        'jenis_pupuk',
        'stok_pupuk',
    ];

    public function tanamans()
    {
        return $this->hasMany(Tanaman::class);
    }
}
