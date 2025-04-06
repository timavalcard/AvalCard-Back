<?php

namespace CMS\Article\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CMS\Article\Http\Requests\AddArticleRequest;
use CMS\Article\Http\Requests\EditArticleRequest;
use CMS\Article\Models\Article;
use CMS\Article\Repositories\ArticleRepository;
use CMS\Comment\Repository\CommentRepository;
use CMS\Common\Services\CommonService;
use CMS\Page\Services\CreateService;
use CMS\PostMeta\Repository\PostMetaRepository;
use CMS\Product\Models\Product;
use CMS\Tag\Repository\TagRepository;


class ArticleController extends Controller
{
    // theme methods
    public function index($category=null,$slug=null)
    {
        if(!$slug) $slug=$category;
        $article=ArticleRepository::find_by_slug($slug);
        $comments=CommentRepository::get_approve_comment($article);
        $related_articles=ArticleRepository::get_related_article_by_category($article);
        $products=PostMetaRepository::limit_by_key(10,"offer_price",(new Product())->getMorphClass(),Product::class);
        $random_articles=ArticleRepository::get_by_limit_random(5);
        return view("Theme::hidi.article",["random_articles"=>$random_articles,"products"=>$products,"article"=>$article,"comments"=>$comments,"related_articles"=>$related_articles]);
    }

    // admin methods
    public function article_list(Request $request)
    {
        $this->authorize("index",Article::class);
        $articles=ArticleRepository::order_article($request->orderBy,$request->name);
        $articles_count=ArticleRepository::get()->count();


        return view("Article::Admin.article_list",["articles"=>$articles,"articles_count"=>$articles_count]);
    }

    public function article_add_form()
    {
        $this->authorize("create",Article::class);
        $categories=ArticleRepository::get_all_category();

        $tags=TagRepository::get_all_tag();


        return view("Article::Admin.article_add",["categories"=>$categories,"tags"=>$tags]);
    }

    public function article_add(AddArticleRequest $request)
    {
        $this->authorize("create",Article::class);
        $slug=make_slug_for_data($request->title,$request->slug);

        $request->request->add(["slug"=>$slug]);

        $article=ArticleRepository::create($request);
        PostMetaRepository::update_meta_tag($article,$request);


        if($request->article_cat){
            ArticleRepository::create_article_category($article,$request->article_cat);
        }

        if($request->article_tag) {
            ArticleRepository::create_article_tag($article,$request->article_tag);
        }
        CreateService::create($article->url."/");
        CommonService::tel_bot("article_add",$article->title);
        return redirect()->route("admin_article_edit",["id"=>$article]);
    }

    public function article_edit_form($id)
    {
        $this->authorize("edit",Article::class);
        $article=ArticleRepository::find($id);
        $categories=ArticleRepository::get_all_category();
        $tags=TagRepository::get_all_tag();

        $articleCat=ArticleRepository::get_article_category($article);
        $articleTag=ArticleRepository::get_article_tag($article);

        return view("Article::Admin.article_edit",["tags"=>$tags,"categories"=>$categories,"article"=>$article,"articleCatId"=>$articleCat,"articleTagId"=>$articleTag]);
    }

    public function article_edit(EditArticleRequest $request)
    {

        $this->authorize("update",Article::class);
        $slug=make_slug_for_data($request->title,$request->slug);
        $request->request->add(["slug"=>$slug]);

        $article=ArticleRepository::find($request->id);
        PostMetaRepository::update_meta_tag($article,$request);

        ArticleRepository::update($article,$request);


        if($article->category){
            ArticleRepository::destroy_article_category($article);
        }

        if($request->article_cat){
            ArticleRepository::create_article_category($article,$request->article_cat);
        }

        if($article->tags){
            ArticleRepository::destroy_article_tag($article);
        }

        if($request->article_tag){
            ArticleRepository::create_article_tag($article,$request->article_tag);
        }
        CreateService::create($article->url."/");
        CommonService::tel_bot("article_edit",$article->title);
        return back();
    }

    public function article_delete($id)
    {
        $this->authorize("delete",Article::class);
        $article=ArticleRepository::find($id);

        if($article->category){
            ArticleRepository::destroy_article_category($article);
        }
        if($article->tags){
            ArticleRepository::destroy_article_tag($article);
        }
        ArticleRepository::destroy($id);
        CreateService::remove($article->url."/");
        CommonService::tel_bot("article_delete",$article->title);
        return back();
    }

    public function group_action(Request $request){
        if($request->action == "delete"){
            ArticleRepository::destroy($request->checkbox_item);
        }
        return back();
    }
}










