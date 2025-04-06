<?php

namespace CMS\PostMeta\Models;

use Illuminate\Database\Eloquent\Model;

class Post_meta extends Model
{
        protected $fillable = [
        'meta_key', 'meta_value',
    ];

    public function metaable(){
        return $this->morphTo(__FUNCTION__, 'post_metaable_type', 'post_metaable_id');
    }

}

