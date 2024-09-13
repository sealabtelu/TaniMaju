<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petani extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_petani',
        'alamat_petani',
        'nomor_telepon',
        'foto',
    ];

    public function sawahs()
    {
        return $this->hasMany(Sawah::class);
    }

    public function panens()
    {
        return $this->hasMany(Panen::class);
    }
}
