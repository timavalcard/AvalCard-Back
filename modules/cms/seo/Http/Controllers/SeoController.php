<?php

namespace CMS\Seo\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CMS\Article\Http\Requests\AddArticleRequest;
use CMS\Article\Http\Requests\EditArticleRequest;
use CMS\Article\Models\Article;
use CMS\Article\Repositories\ArticleRepository;
use CMS\Comment\Repository\CommentRepository;
use CMS\Seo\Models\Redirect;
use CMS\Setting\Repository\SettingRepository;
use CMS\Tag\Repository\TagRepository;


class SeoController extends Controller
{
   public function index(){
       return view("Seo::Admin.index");
   }

   public function redirect(){
       $redirects=Redirect::query()->orderByDesc("created_at")->paginate(15);
       return view("Seo::Admin.redirects",compact("redirects"));
   }
    public function redirect_add_form(){
        return view("Seo::Admin.add_redirect");
    }
    public function redirect_add(Request $request){
        Redirect::query()->create([
            "redirect_from"=>$request->redirect_from,
            "redirect_to"=>$request->redirect_to,
            "status_code"=>$request->status_code,
        ]);
        return redirect()->route("admin_seo_redirect");
    }
    public function redirect_edit_form($id){
       $redirect=Redirect::query()->findOrFail($id);
        return view("Seo::Admin.edit_redirect",compact("redirect"));
    }
    public function redirect_edit($id,Request $request){
        $redirect=Redirect::query()->findOrFail($id);
        if($redirect){
            $redirect->update([
                "redirect_from"=>$request->redirect_from,
                "redirect_to"=>$request->redirect_to,
                "status_code"=>$request->status_code,
            ]);
        }
        return redirect()->route("admin_seo_redirect");
    }

    public function redirect_delete($id){
        Redirect::destroy($id);
       return back();
    }

   public function bing(){
       $bing_api=SettingRepository::getOption("bing_api");
       return view("Seo::Admin.bing",compact("bing_api"));
   }
    public function google(){
        $google_api=SettingRepository::getOption("google_api");
        return view("Seo::Admin.google",compact("google_api"));
    }

   public function bing_save(Request $request){
       SettingRepository::create_setting(["bing_api"=>$request->bing_api]);
        return back();
   }
    public function google_save(Request $request){
        SettingRepository::create_setting(["google_api"=>$request->google_api]);
        return back();
    }
}










