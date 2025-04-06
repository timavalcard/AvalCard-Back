<?php
namespace CMS\Media\Services;


use CMS\Media\Contracts\FileServiceContract;
use CMS\Media\Models\Media;
use Illuminate\Support\Facades\Storage;

class VideoFileService extends DefaultFileService implements FileServiceContract
{
    public static function upload($file, $filename, $dir) : array
    {
        $filename = uniqid();
        $filePath=Storage::disk('ftp')->put('/hidi', $file);
        return ["file" => $filePath];
    }

    public static function thumb(Media $media,$size=100)
    {
        return url("/img/video-thumb.png");
    }
}
