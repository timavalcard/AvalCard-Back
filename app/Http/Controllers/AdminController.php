<?php

namespace App\Http\Controllers;


use App\Attribute;
use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Menu;
use App\Newsletter;
use App\Newsletter_mail;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Tag;
use App\Page;
use App\User;
use App\Comment;
use Illuminate\Support\Str;
class AdminController extends Controller
{
    public function article_delete_group($id)
    {

        Article::destroy($id);
        return back();
    }

    public function group_action(Request $request){
        switch($request->type){
            case("comment"):
                switch($request->action){
                    case("delete"):
                        $this->delete_comment($request->checkbox_item);
                        return back();
                        break;
                    case("unapproved"):

                        $this->unAprrovedComment($request->checkbox_item);
                         return back();
                        break;
                    case("approved"):
                        $this->arrovedComment($request->checkbox_item);
                         return back();
                        break;
                }
                break;
            case "page":
                switch($request->action){
                    case "delete":
                    $this->delete_page($request->checkbox_item);
                    return back();
                    break;
                }
                break;

            case "newsletter":
                switch($request->action){
                    case "delete":
                        $this->delete_newsletter($request->checkbox_item);
                        return back();
                        break;
                }
                break;

            case "newsletter_send":
                switch($request->action){

                    case "delete":

                        $this->delete_newsletter_send($request->checkbox_item);
                        return back();
                        break;
                }
                break;
            case "article":
                switch($request->action){

                    case "delete":

                        $this->article_delete_group($request->checkbox_item);
                        return back();
                        break;
                }
                break;
        }
    }


}
