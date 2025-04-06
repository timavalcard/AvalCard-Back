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
            $data=json_encode([
                [
                    "label"=>"نام و نام خانوادگی",
                    "value"=>$request->input_1,
                ],
                [
                    "label"=>"تلفن همراه",
                    "value"=>$request->input_10,
                ],

                [
                    "label"=>"توضیح",
                    "value"=>$request->input_5,
                ],
            ]);
            $form=FormsRepository::find(1);
        }
        FormsRepository::add_entrance($form,$data);
        return response()->json(["success"=>"add"]);



    }
}










