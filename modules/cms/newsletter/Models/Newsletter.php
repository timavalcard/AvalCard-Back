<?php

namespace CMS\Newsletter\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
   protected $fillable=[
       "title",
       "message",
       "sendsTo"
   ];
}
