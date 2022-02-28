<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;

    public function guideQuestions()
    {
        return $this->belongsToMany(GuideQuestion::class);
    }

    public function titleLower()
    {
        return strtolower($this->title);
    }
}
