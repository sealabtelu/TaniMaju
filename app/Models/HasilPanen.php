<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPanen extends Model
{
    use HasFactory;

    protected $fillable = [
        'petani_id', 'lahan_id', 'bibit_id', 'tanaman_id', 'pupuk_id',
        'jumlah_hasil_panen', 'status_penjualan', 'nama_pembeli', 'deskripsi','foto'
    ];

    public function petani()
    {
        return $this->belongsTo(Petani::class);
    }

    public function lahan()
    {
        return $this->belongsTo(Lahan::class);
    }

    public function bibit()
    {
        return $this->belongsTo(Bibit::class);
    }

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class);
    }

    public function pupuk()
    {
        return $this->belongsTo(Pupuk::class);
    }
}
