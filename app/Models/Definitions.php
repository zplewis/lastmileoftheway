<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Definitions extends Model
{
    use HasFactory;

    public function similarTerms()
    {
        return $this->hasMany(SimilarTerms::class);
        // return $this->belongsToMany(SimilarTerms::class);
    }

    public function slug() : string
    {
        return Str::of($this->term)->slug('-');
    }

    private function getTermAsLinkString(string $term) : string
    {
        $slug = Str::of($term)->slug('-');
        return "<a href=\"#$slug\" title=\"$term\">$term</a>";
    }

    public function similarTermsAsLinks() : string
    {
        // 1. Get the similar terms as an array
        $similars = $this->similarTerms()->get();

        $definitions = [];

        foreach ($similars as $similar) {
            $definitions[] = $similar->similar()->first()->term;
        }

        // TODO: Fix this, as we need to get the actual similar terms, and this
        // table gives you the IDs

        if (!$definitions) {
            return '';
        }

        // 2. Get the terms as an array of links
        // Have to specify the function like this:
        // https://stackoverflow.com/a/5422280/1620794
        $links = array_map(array($this, 'getTermAsLinkString'), $definitions);

        // 3. Implode the array of links to add commas in-between them
        return implode(', ', $links);
    }
}
