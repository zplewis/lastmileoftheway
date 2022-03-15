<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scriptures extends Model
{
    use HasFactory;

    public function bible_book()
    {
        return $this->belongsTo(BibleBook::class);
    }

    public function bible_versions() {
        return $this->belongsTo(BibleVersions::class);
    }
}
