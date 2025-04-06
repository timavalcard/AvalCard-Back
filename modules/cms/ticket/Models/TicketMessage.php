<?php

namespace CMS\Ticket\Models;

use CMS\Media\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use CMS\Article\Models\Article;
use CMS\Page\Models\Page;
use CMS\Product\Models\Product;
use CMS\User\Models\User;

class TicketMessage extends Model
{
    protected $table="ticket_messages";
    protected $fillable=["ticket_id","user_id","message","is_admin","media_id"];
    public function user(){

        return $this->belongsTo(User::class);
    }
    public function ticket()
    {

        return $this->belongsTo(Ticket::class);
    }
    public function media()
    {
        return $this->belongsTo(Media::class);
    }
}
