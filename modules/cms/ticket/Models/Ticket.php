<?php

namespace CMS\Ticket\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use CMS\Article\Models\Article;
use CMS\Page\Models\Page;
use CMS\Product\Models\Product;
use CMS\User\Models\User;


class Ticket extends Model
{
     protected $fillable=["subject","user_id","status","priority","department"];
     public function user(){

        return $this->belongsTo(User::class);
    }


    public function messages()
    {

        return $this->hasMany(TicketMessage::class,"ticket_id","id");
    }


}
