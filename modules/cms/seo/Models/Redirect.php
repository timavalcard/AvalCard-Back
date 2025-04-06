<?php

namespace CMS\Seo\Models;

use CMS\PostMeta\Models\Post_meta;
use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $fillable=["status_code","redirect_from","redirect_to"];


}
