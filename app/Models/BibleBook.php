<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BibleBook extends Model
{
    use HasFactory;

    public function testament()
    {
        return $this->belongsTo(Testament::class);
    }
}
