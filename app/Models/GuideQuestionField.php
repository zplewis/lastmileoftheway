<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideQuestionField extends Model
{
    use HasFactory;

    protected $appends = ['required'];

    public function guideQuestion()
    {
        return $this->hasOne(GuideQuestion::class);
    }

    /**
     * Returns true if a validation rule is specified.
     */
    public function getRequiredAttribute()
    {
        return !empty($this->validation);
    }
}
