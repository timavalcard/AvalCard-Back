<?php

namespace CMS\Marketing\Models;


use Illuminate\Database\Eloquent\Model;
use CMS\User\Models\User;

class Entrance extends Model
{
    protected $table="affiliate_entrance";
    protected $fillable=["affiliate_id","link","user_ip","status"];

    public function user()
    {
        return $this->belongsTo(User::class,"affiliate_id");
    }

}
