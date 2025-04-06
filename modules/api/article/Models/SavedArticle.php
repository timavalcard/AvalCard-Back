<?php

namespace API\Article\Models;

use Illuminate\Database\Eloquent\Model;

use CMS\User\Models\User;

class SavedArticle extends Model
{
    protected $fillable=["user_id","article_id"];
    protected $table="saved_articles";
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
