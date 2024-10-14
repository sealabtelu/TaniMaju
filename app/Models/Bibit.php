<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bibit extends Model
{
    use HasFactory;

    protected $fillable = ['tanaman_id', 'sumber', 'nama_penyedia'];

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class);
    }
}

