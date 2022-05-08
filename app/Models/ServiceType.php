<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;

    /**
     * Get the route key for the model.
     * This setting determines what column is associated with the URL path "guidecategory".
     * That is configured in RouteServiceProvider.php
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'title';
    }

    public function guideQuestions()
    {
        return $this->belongsToMany(GuideQuestion::class, 'guide_question_service_type', 'service_type_id', 'guide_question_id');
    }

    public function titleLower()
    {
        return strtolower($this->title);
    }
}
