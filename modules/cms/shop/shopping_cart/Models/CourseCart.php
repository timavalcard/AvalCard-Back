<?php

namespace CMS\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use CMS\User\Models\User;

class CourseCart extends Model
{
    protected $table = "course_cart";
    protected $fillable = ["user_id","cart_item"];
    protected $casts = ["cart_item"=>"json"];
    public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }


}
