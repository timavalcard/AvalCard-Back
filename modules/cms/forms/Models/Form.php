<?php

namespace CMS\Forms\Models;

use CMS\PostMeta\Models\Post_meta;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable=["name","fields"];
    public function entrance()
    {
        return $this->hasMany(FormsEntrance::class);
    }

}
