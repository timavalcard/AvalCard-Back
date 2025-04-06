<?php

namespace API\Article\Models;

use Illuminate\Database\Eloquent\Model;

use CMS\User\Models\User;

class ArticleLiked extends Model
{
    protected $fillable=["ip","article_id","type"];
    protected $table="article_likes";
    public function article()
    {
        return $this->belongsTo(Article::class);
    }


}
