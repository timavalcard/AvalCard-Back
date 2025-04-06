<?php

namespace API\Article\Models;

use Illuminate\Database\Eloquent\Model;

use CMS\User\Models\User;

class ArticleView extends Model
{
    protected $fillable=["ip","article_id"];
    protected $table="article_viewes";
    public function article()
    {
        return $this->belongsTo(Article::class);
    }


}
