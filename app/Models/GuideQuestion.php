<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideQuestion extends Model
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
        return 'uri';
    }

    public function serviceTypes()
    {
        return $this->belongsToMany(ServiceType::class, 'guide_question_service_type', 'guide_question_id', 'service_type_id');
    }

    public function service_type()
    {
        return $this->serviceTypes();
    }

    public function guideCategory()
    {
        return $this->belongsTo(GuideCategory::class);
    }

    public function pageUri()
    {
        return 'guide/' . $this->guideCategory()->first()->uri . '/' . $this->uri;
    }

    public function guideQuestionFields()
    {
        return $this->hasMany(GuideQuestionField::class);
    }
}
