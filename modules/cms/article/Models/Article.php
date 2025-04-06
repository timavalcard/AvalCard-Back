<?php

namespace CMS\Article\Models;


use CMS\Comment\Models\Comment;
use CMS\Media\Models\Media;
use CMS\Media\Service\MediaService;
use CMS\PostMeta\Models\Post_meta;
use CMS\Tag\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use CMS\Category\Models\Category;
use CMS\User\Models\User;
use Spatie\Permission\Models\Role;

class Article extends Model
{
    protected $table="articles";
    protected $fillable=["title","post_excerpt","content","media_id","user_id","slug"];

    public function category()
    {
        return $this->morphToMany(Category::class, 'categoryable');
    }
public function tags()
    {
        return $this->morphToMany(Tag::class, 'tagables');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function post_meta(){
        return $this->morphMany(Post_meta::class, 'post_metaable');
    }

    public function getPostMetaArrayAttribute(){
        return $this->post_meta->pluck("meta_value","meta_key");
    }

    public function comments()
    {
        return $this->morphMany(Comment::class,"commentable","comment_able_type","comment_able_id");
    }

    public function getSmallImage()
    {
        if($this->media){
            $file=$this->media->files["original"];
            if(isset($this->media->files["100"])) $file=$this->media->files["100"];

            return store_image_link().'/'.$file;
        }
    }

    public function getUrlAttribute()
    {
        $category=$this->category;
        if($category->isEmpty()){

            return route("article.index",["slug"=>$this->slug]);
        } elseif(isset($category[0])){
            $category=$category[0];
            if($category->parent==0){
                return route("article.index2",["slug"=>$this->slug,"category"=>$category->slug]);
            } else{
                return route("article.index2",["slug"=>$this->slug,"category"=>$category->slug]);
            }
        }
    }

    public function getCommentCountAttribute(){
        if($this->comments){
            return count($this->comments);
        }
        return 0;
    }

}
