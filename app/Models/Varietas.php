<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Varietas extends Model
{
    use HasFactory;

    protected $fillable = ['nama_varietas'];

    public function panens()
    {
        return $this->hasMany(Panen::class);
    }
}
