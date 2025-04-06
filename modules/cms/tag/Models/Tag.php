<?php

namespace CMS\Tag\Models;

use Illuminate\Database\Eloquent\Model;
use CMS\Article\Models\Article;

class Tag extends Model
{
    protected $table="tags";
    protected $fillable=["name","slug","created_at","updated_at","content"];
    public static $post_type=[];

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'tagables');
    }
}
