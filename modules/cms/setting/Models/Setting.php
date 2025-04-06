<?php

namespace CMS\Setting\Models;


use CMS\Comment\Models\Comment;
use CMS\Media\Models\Media;
use CMS\Media\Service\MediaService;
use CMS\PostMeta\Models\Post_meta;
use CMS\Tag\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use CMS\Category\Models\Category;
use CMS\User\Models\User;
use Spatie\Permission\Models\Role;

class Setting extends Model
{
    protected $table="setting";
    protected $fillable=["setting_key","setting_value"];

    protected $casts=["setting_value"=>"json"];

}
