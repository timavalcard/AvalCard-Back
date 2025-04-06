<?php
namespace CMS\Media\Models;

use CMS\Media\Services\MediaFileService;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $casts = [
        'files' => 'json'
    ];

    protected static function booted(){
        static::deleting(function ($media) {
            MediaFileService::delete($media);
        });
    }

    public function getThumbAttribute($size="original")
    {
        return MediaFileService::thumb($this,$size);
    }

    public function getUrlAttribute($size="original")
    {

        $thumbnail=$this->getThumbAttribute($size);

        return url($thumbnail);
    }


}
