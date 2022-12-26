<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertandinganKlub extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function klub()
    {
        return $this->belongsTo(Klub::class);
    }

    public function pertandingan()
    {
        return $this->belongsTo(Pertandingan::class);
    }
}
