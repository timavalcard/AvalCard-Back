<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 9/1/2020
 * Time: 2:54 PM
 */

namespace CMS\Media\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CMS\Media\Http\Requests\MediaRequest;
use CMS\Media\Http\Requests\UserAddMediaRequest;
use CMS\Media\Models\Media;
use CMS\Media\Service\MediaService;
use CMS\Media\Services\MediaFileService;

class MediaController extends Controller
{
    // user functions

    public function user_update_profile(UserAddMediaRequest $request){
        $image=MediaFileService::publicUpload($request->user_image);

    }
    public function download(Media $media, Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }
        return MediaFileService::stream($media);
    }

    //admin functions
    public function list_media()
    {
        $files = Media::get();
        return view("Media::Admin.list_media",["files"=>$files]);
    }
    public function save_alt(Request $request){
        $media=Media::query()->find($request->id);
        if($media){
            $media->alt=$request->alt;
            $media->save();
        }
    }
    public function delete_media(Media $media)
    {
       $media->delete();
        return back();

    }
    public function add_media_form(){
        return view("Media::Admin.add_media");
    }


    public function add_media(MediaRequest $request)
    {
        $items=[];
        foreach($request->media_field as $file){
            $items[]=MediaFileService::publicUpload($file);
        }
        if($request->ajax()){
        return ["message"=>"فایل ها با موفقیت اپلود شدند","items"=>$items];

        } else{
            return  back();
        }
    }

    public function get_all_media()
    {
        $files = get_all_file_in_public();
        $fileForReturn=[];
        foreach ($files as $file){
            $file=array_slice(explode("/",$file),-1,1,false)[0];
            if(MediaService::get_image_size_by_file_name($file , "100")){
                $fileForReturn[]=$file;
            }
        }
        return $fileForReturn;
    }
}
