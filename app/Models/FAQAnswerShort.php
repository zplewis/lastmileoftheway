<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FAQAnswerFull;

class FAQAnswerShort extends Model
{
    use HasFactory;

    public function getFullAnswer()
    {
        return FAQAnswerFull::firstOrNew(
            [

            ]
        )
    }
}
