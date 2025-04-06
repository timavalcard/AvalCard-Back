<?php

namespace CMS\User\Models;

use Illuminate\Database\Eloquent\Model;

class User_meta extends Model
{
     protected $fillable = [
        'meta_key', 'meta_value',
    ];
     protected $casts=[
         "meta_value"=>"json"
     ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
