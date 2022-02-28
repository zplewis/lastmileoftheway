<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;

    public function guideQuestions()
    {
        return $this->belongToMany(GuideQuestion::class, 'guide_question_service_type', 'service_type_id', 'guide_question_id');
    }

    public function titleLower()
    {
        return strtolower($this->title);
    }
}
