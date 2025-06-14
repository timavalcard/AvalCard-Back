<?php

namespace API\Page\Http\Controllers;

use API\Page\Http\Resources\PageResource;
use API\Page\Repositories\APIPageRepository;
use App\Http\Controllers\Controller;
use CMS\Forms\Repository\FormsRepository;
use Illuminate\Http\Request;


class PageController extends Controller
{
    public function page_content(){
        $page=APIPageRepository::find_by_slug_not_fail(request()->slug);
        if($page){
            return new PageResource($page);
        }
        return null;
    }

    public function addFormEntrance(Request $request){

        if ($request->form_id==1){

            $data=[
                [
                    "label"=>"نام",
                    "value"=>$request->name,
                ],
                [
                    "label"=>"ایمیل",
                    "value"=>$request->email,
                ],
                [
                    "label"=>"تلفن همراه",
                    "value"=>$request->phone,
                ],
                [
                    "label"=>"بخش",
                    "value"=>$request->unit,
                ],
                [
                    "label"=>"توضیح",
                    "value"=>$request->message,
                ],
            ];

            $form=FormsRepository::find(1);
        }
        FormsRepository::add_entrance($form,$data);
        return response()->json(["success"=>"add"]);



    }
}










