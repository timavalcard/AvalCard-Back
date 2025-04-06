<?php

namespace CMS\NewsletterEmail\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter_mail extends Model
{
    protected $fillable=["user_id","email"];
}
