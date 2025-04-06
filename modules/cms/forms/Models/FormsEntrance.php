<?php

namespace CMS\Forms\Models;

use CMS\PostMeta\Models\Post_meta;
use Illuminate\Database\Eloquent\Model;

class FormsEntrance extends Model
{
    protected $fillable=["form_id","values","status"];
    protected $table="forms_entrances";
    protected $casts=["values"=>"json"];
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
