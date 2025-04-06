<?php

namespace CMS\Page\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CMS\Article\Repositories\ArticleRepository;
use CMS\Category\Repositories\CategoryRepository;
use CMS\Comment\Repository\CommentRepository;
use CMS\Course\Repositories\CourseRepo;
use CMS\Page\Http\Requests\AddPageRequest;
use CMS\Page\Http\Requests\EditPageRequest;
use CMS\Page\Models\Page;
use CMS\Page\Repository\PageRepository;
use CMS\Page\Services\CreateService;
use CMS\PostMeta\Repository\PostMetaRepository;
use CMS\Product\Models\Product;
use CMS\Product\Repository\ProductRepository;
use CMS\ThemeSetting\Repository\ThemeSettingRepository;
use CMS\Service\Repositories\ServiceRepo;

class PageController extends Controller
{
    //theme functions

    public function index($slug,Request $request)
    {
        if ($slug=="search"){
            $view="Theme::hidi.search";
            if(!$request->type){
                $data["products"]=ProductRepository::like($request->s,12);
                $data["categories"]=CategoryRepository::get_by_type("product");
                $data["cheapest_product"]=ProductRepository::order_by_attribute_by_category("regular_price",null,"asc");
                $data["expensive_product"]=ProductRepository::order_by_attribute_by_category("regular_price",null,"desc");
            } elseif ($request->type=="product"){
                $data["products"]=ProductRepository::like($request->s,-1);
            }elseif ($request->type=="course"){
                $data["courses"]=CourseRepo::like($request->s,-1);
            }elseif ($request->type=="article"){
                $data["articles"]=ArticleRepository::like($request->s,-1);
            }

            return view($view,["data"=>$data]);
        }
        $page=PageRepository::find_by_slug($slug);
        if($page){
            $data=[];
            if(view()->exists("Theme::hidi.page-".$slug)){
                $view="Theme::hidi.page-".$slug;
            } else{
                $view="Theme::hidi.page";
            }
            if($slug=="blog"){
                $data["articles"]=ArticleRepository::order_article();
                $data["products"]=PostMetaRepository::limit_by_key(10,"offer_price",(new Product())->getMorphClass(),Product::class);
                $data["random_articles"]=ArticleRepository::get_by_limit_random(5);
            }

            if($slug=="academy"){
                $data["courses"]=CourseRepo::get_by_limit_not_type();
                $data["video_courses"]=CourseRepo::get_by_limit("video");
                $data["podcast_courses"]=CourseRepo::get_by_limit("podcast");
                $data["book_courses"]=CourseRepo::get_by_limit("book");
                $data["categories"]=CategoryRepository::get_by_type("course");
            }

            return view($view,["page"=>$page,"data"=>$data]);
        }
        return abort(404);
    }

    //admin functions
    public function list_page(Request $request){
        $this->authorize("index",Page::class);
        $pages=PageRepository::order_page($request->orderBy,$request->name);
        return view("Page::Admin.page_list",["pages"=>$pages]);
    }

    public function add_page_form (){
        $this->authorize("create",Page::class);
        return view("Page::Admin.page_add");
    }

    public function add_page(AddPageRequest $request)
    {
        $this->authorize("create",Page::class);
        $slug=make_slug_for_data($request->title,$request->slug);

        $request->request->add(["slug"=>$slug]);

        $pageId=PageRepository::create($request);
        PostMetaRepository::update_meta_tag($pageId,$request);
        CreateService::create($pageId->url."/");
        return redirect()->route("admin_edit_page",["id"=>$pageId->id]);
    }
    public function edit_page_form($id)
    {
        $this->authorize("edit",Page::class);
        $page=PageRepository::find($id);


        return view("Page::Admin.page_edit",["page"=>$page]);
    }

    public function edit_page (EditPageRequest $request)
    {
        $this->authorize("update",Page::class);
        $slug=$request->slug;

        if($slug != "/"){
            $slug=make_slug_for_data($request->title,$slug);

        }
        $request->request->add(["slug"=>$slug]);

        $page=PageRepository::find($request->id);
        PostMetaRepository::update_meta_tag($page,$request);
        PageRepository::update($page,$request);
        CreateService::create($page->url."/");
        return back();
    }
    public function delete_page($id)
    {
        $this->authorize("delete",Page::class);
        $page=PageRepository::find($id);
        PageRepository::destroy($id);
        CreateService::remove($page->url."/");
        return back();
    }

}
