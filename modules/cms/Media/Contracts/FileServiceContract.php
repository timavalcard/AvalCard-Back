<?php


namespace CMS\Media\Contracts;


use CMS\Media\Models\Media;
use Illuminate\Http\UploadedFile;

interface FileServiceContract
{
    public static function upload(UploadedFile $file, string $filename, string $dir) :array ;

    public static function delete(Media $media);

    public static function thumb(Media $media,$size=100);
}
