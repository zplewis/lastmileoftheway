<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Definitions extends Model
{
    use HasFactory;

    public function similarTerms()
    {
        return $this->hasMany(SimilarTerms::class);
    }
}
