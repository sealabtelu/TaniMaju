<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanaman extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'pupuk_id'];

    public function pupuk()
    {
        return $this->belongsTo(Pupuk::class);
    }
}

