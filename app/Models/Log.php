<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use CMS\User\Models\User;

class Log extends Model
{
    protected $fillable = ['level',"url","referrer", 'message', 'context'];
    public $timestamps = false;


}
