<?php

namespace API\Article\Http\Controllers;

use API\Product\Http\Resources\ProductResource;
use App\Http\Controllers\Controller;
use CMS\Comment\Repository\CommentRepository;
use CMS\Product\Repository\ProductRepository;
use Illuminate\Http\Request;
use API\Article\Http\Resources\ArticleResource;
use CMS\Article\Models\Article;
use CMS\Article\Repositories\ArticleRepository;
use API\Article\Repositories\APIArticleRepository;


class ArticleController extends Controller
{
    public function recent_articles(){
        $articles=Article::query()->orderByDesc("created_at")->paginate((int) request()->limit,['*'],"page",\request()->page??1);
        return ArticleResource::collection($articles);
    }
    public function article_detail(){

        $article=ArticleRepository::find_by_slug(request()->slug);
        $related=ArticleRepository::get_related_article_by_category($article);
        return [
            "article"=>new ArticleResource($article),
            "related_articles"=> ArticleResource::collection($related)
        ];
    }
    public function search(){
        $articles=ArticleRepository::like(request()->title);
        $gift_carts=ProductRepository::like(request()->title,20,"gift_cart");
        $buy_products=ProductRepository::like(request()->title,20,"buy_product");
        $inter_payments=ProductRepository::like(request()->title,20,"inter_payment");
        return [
            "articles"=>ArticleResource::collection($articles),
            "gift_carts"=>ProductResource::collection($gift_carts),
            "buy_products"=>ProductResource::collection($buy_products),
            "inter_payments"=>ProductResource::collection($inter_payments),
        ];
    }


    public function saved_article(Request $request){
        $user = $request->user();
        if($user){
            APIArticleRepository::handle_saved_article($request->article_id,$user);
            $is_saved=false;
            $saved=APIArticleRepository::get_article_and_user_saved($request->article_id,$user);
            if($saved){
                $is_saved=true;
            }

            return $is_saved;
        } else{
            return response()->json(["url"=>route("auth.index")]);
        }
    }

    public function check_saved_article(Request $request){
        $user = $request->user();
        $is_saved=false;
        if($user){
            $saved=APIArticleRepository::get_article_and_user_saved($request->article_id,$user);
            if($saved){
                $is_saved=true;
            }
        }

        return $is_saved;
    }

    public function saved_articles_list(Request $request){
        $user = $request->user();
        if($user){
            $saved_articles=$user->saved_article()->orderByDesc("created_at")->pluck("article_id");
            $articles=Article::query()->whereIn("id",$saved_articles);
            if($request->title){
                $articles->where("title","like","%".$request->title."%");
            }

            $articles=$articles->paginate(\request()->limit);
            $pagination=[
                'per_page'=>$articles->perPage() ,
                'total'=>$articles->total() ,
                'last_page'=>$articles->lastPage() ,
                'current_page'=>$articles->currentPage() ,
            ];
            return [
                "articles"=>ArticleResource::collection($articles),
                "pagination"=>$pagination,
            ];
        }

    }

    public function like(Request $request)
    {
        $ipAddress = $request->ip();
        if(!APIArticleRepository::is_ip_liked($ipAddress,$request->article_id)){
            APIArticleRepository::like_article($request->article_id,$ipAddress,$request->type);
            return true;
        }
        return false;
    }

    public function check_like(Request $request){
        $ipAddress = $request->ip();
        if(APIArticleRepository::is_ip_liked($ipAddress,$request->article_id)){
            return true;
        }
        return false;
    }

    public function add_view(Request $request){
        $ipAddress = $request->ip();
        if(!APIArticleRepository::is_ip_viewed($ipAddress,$request->article_id)){
            APIArticleRepository::add_article_view($request->article_id,$ipAddress);
        }
    }

    public function add_comment(Request $request){
        $article=ArticleRepository::find($request->article_id);


        $request->request->add(["post_type"=>"article","user_id"=>$request->user()->id,"parent_id"=>0,"post_id"=>$request->article_id,"type"=>"comment"]);
        $comment=CommentRepository::create($request,0);
        return $comment;
    }
}










