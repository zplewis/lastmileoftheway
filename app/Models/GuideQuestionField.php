<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideQuestionField extends Model
{
    use HasFactory;

    public function guideQuestion()
    {
        return $this->hasOne(GuideQuestion::class);
    }
}
