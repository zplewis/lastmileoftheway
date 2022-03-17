<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuideQuestion extends Model
{
    use HasFactory;

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
}
