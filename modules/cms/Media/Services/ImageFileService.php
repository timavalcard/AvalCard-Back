<?php
namespace CMS\Media\Services;


use CMS\Media\Contracts\FileServiceContract;
use CMS\Media\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageFileService extends DefaultFileService implements FileServiceContract
{
    protected static $sizes = ['100','300', '600'];
    protected static $size_thumbnail = '300';
    protected static $size_original = 'original';

    public static function upload(UploadedFile $file,$filename, $dir) :array
    {
        //Storage::putFileAs( $dir , $file, $filename . '.' . $file->getClientOriginalExtension());
        $extension = strtolower($file->getClientOriginalExtension());
        $file->move(storage_path($dir), $filename . '.' . $extension);
        $path = $dir . $filename .  '.' . $extension;

        return self::resize(storage_path($path), $dir, $filename, $file->getClientOriginalExtension());
    }

    private static function resize($img, $dir, $filename, $extension)
    {
        $img = Image::make($img);
        $imgs['original'] =  $filename . '.' . $extension;
        foreach (self::$sizes as $size) {
            $imgs[$size] = $filename . '_'. $size. '.' . $extension;
            $img->resize($size, null, function ($aspect) {
                $aspect->aspectRatio();
            })->save(storage_path($dir) . $filename . '_'. $size. '.' . $extension);
        }
        return $imgs;
    }

    public static function thumb(Media $media,$size=100)
    {
        if(!in_array($size , self::$sizes)){
            $size=self::$size_original;
        }
        return "/storage/" . $media->files[$size];
    }
}
