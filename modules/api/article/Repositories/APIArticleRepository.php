<?php
namespace API\Article\Repositories;

use CMS\Category\Models\Category;
use CMS\Tag\Models\Tag;
use CMS\Article\Models\Article;
use API\Article\Models\ArticleLiked;
use API\Article\Models\ArticleView;
use API\Article\Models\SavedArticle;

class APIArticleRepository
{

    public static function handle_saved_article ($article_id,$user){
        if(!$wishlist=self::get_article_and_user_saved($article_id,$user)){
            return SavedArticle::create([
                "article_id"=>$article_id,
                "user_id"=>$user->id,
            ]);
        } else{
            $wishlist->delete();
        }
    }

    public static function get_article_and_user_saved($article_id,$user){
        return SavedArticle::query()->where("article_id",$article_id)->where("user_id",$user->id)->first();
    }


    public static function is_ip_liked($ip,$article){
        return ArticleLiked::query()->where("ip",$ip)->where("article_id",$article)->first();
    }

    public static function is_ip_viewed($ip,$article){
        return ArticleView::query()->where("ip",$ip)->where("article_id",$article)->first();
    }
    public static function add_article_view($article,$ip){
        return ArticleView::create([
            "article_id"=>$article,
            "ip"=>$ip,
        ]);
    }

    public static function like_article($article,$ip,$type){
        return ArticleLiked::create([
            "article_id"=>$article,
            "type"=>$type,
            "ip"=>$ip,
        ]);
    }

}
