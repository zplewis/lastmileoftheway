<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimilarTerms extends Model
{
    use HasFactory;

    public function definition()
    {
        return $this->belongsTo(Definitions::class);
    }

    public function similar()
    {
        return $this->belongsTo(Definitions::class, 'similar_id');
    }
}
