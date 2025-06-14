<?php

namespace CMS\Page\Models;

use CMS\PostMeta\Models\Post_meta;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable=["title","post_excerpt","content","user_id","slug"];

    public function post_meta(){
        return $this->morphMany(Post_meta::class, 'post_metaable');
    }

    public function getPostMetaArrayAttribute(){
        return $this->post_meta->pluck("meta_value","meta_key");
    }

    public function getUrlAttribute()
    {
        if($this->slug == "home"){
            return env("FRONT_URL");
        }

        return route("page.index",["slug"=>$this->slug]);
    }
}
