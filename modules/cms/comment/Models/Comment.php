<?php

namespace CMS\Comment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use CMS\Article\Models\Article;
use CMS\Page\Models\Page;
use CMS\Product\Models\Product;
use CMS\User\Models\User;

class Comment extends Model
{
     protected $fillable=["text","user_id","email","name","status","parent_id","comment_able_id","comment_able_type","type"];
     public function user(){

        return $this->belongsTo(User::class);
    }
     public function commentable()
    {
        return $this->morphTo(__FUNCTION__,"comment_able_type","comment_able_id");
    }

    public function parent()
    {

        return $this->belongsTo(self::class,"parent_id","id");
    }

    public function children()
    {

        return $this->hasMany(self::class,"parent_id","id");
    }
    protected static function booted()
    {
        parent::boot();
        static::creating(function ($comment) {
           $comment["user_id"]=auth()->id();
            if(request()->parent==0){
                Schema::disableForeignKeyConstraints();
            }

        });
        static::created(function ($comment) {
            Schema::enableForeignKeyConstraints();
        });
        parent::boot();


    }
}
