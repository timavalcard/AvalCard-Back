<?php

namespace CMS\Services\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use CMS\Article\Models\Article;
use CMS\Cart\Models\Cart;
use CMS\Comment\Models\Comment;
use CMS\Media\Models\Media;
use CMS\Media\Services\MediaFileService;
use Spatie\Permission\Traits\HasRoles;

class Services extends Model
{
    protected $fillable = [
        'name','slug','parent','media_id'
    ];
    public function media()
    {
        return $this->belongsTo(Media::class);
    }
    public function getSmallImage()
    {
        return store_image_link().'/'.$this->media->files["100"];
    }

}
