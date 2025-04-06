<?php


namespace CMS\Media\Services;


use CMS\Media\Contracts\FileServiceContract;
use CMS\Media\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ZipFileService  extends DefaultFileService  implements FileServiceContract
{
    public static $media;
    public static function upload(UploadedFile $file, $filename, $dir) :array
    {
        $filename=$filename.  '.' . $file->getClientOriginalExtension();
        $filePath=Storage::disk('ftp')->put('/hidi', $file);
        return ["file" => $filePath];
    }

    public static function thumb(Media $media,$size=100)
    {
        return url("/img/zip-thumb.png");
    }
    public static function getFilename()
    {
        return static::$media->files['file'];
    }

    public static function stream(Media $media)
    {
        static::$media = $media;
        return Storage::disk('ftp')->download(static::getFilename(),static::$media->filename,[
            "Content-Type" => Storage::disk('ftp')->mimeType(static::getFilename()),
            "Content-disposition" => "attachment; filename='" . static::$media->filename ."'"
        ]);
    }

}
