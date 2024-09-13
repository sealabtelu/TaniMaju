<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanaman_id',
        'varietas_id',
        'pupuk_id',
        'petani_id',
        'sawah_id',
        'status_panen',
        'dokumentasi',
        'jumlah'
    ];

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class);
    }

    public function varietas()
    {
        return $this->belongsTo(Varietas::class);
    }

    public function pupuk()
    {
        return $this->belongsTo(Pupuk::class);
    }

    public function sawah()
    {
        return $this->belongsTo(Sawah::class);
    }

    public function petani()
    {
        return $this->belongsTo(Petani::class);
    }
}
