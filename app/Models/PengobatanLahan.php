<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengobatanLahan extends Model
{
    use HasFactory;

    protected $fillable = ['petani_id', 'lahan_id', 'jenis_pengobatan', 'deskripsi_pengobatan'];

    public function petani()
    {
        return $this->belongsTo(Petani::class);
    }

    public function lahan()
    {
        return $this->belongsTo(Lahan::class);
    }
}