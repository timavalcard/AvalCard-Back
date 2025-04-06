<?php
namespace CMS\Article\Repositories;

use CMS\Category\Models\Category;
use CMS\Tag\Models\Tag;
use CMS\Article\Models\Article;

class ArticleRepository
{

    public static function get_articles_by_category(Category $category)
    {
        return $category->articles;
    }
    public static function get(){
        return Article::query()->orderByDesc("updated_at")->get();
    }

    public static function get_by_limit($limit=5){
        return Article::query()->limit($limit)->get();
    }
    public static function get_by_limit_random($limit=4){
        return Article::query()->limit($limit)->inRandomOrder()->get();
    }

    public static function get_related_article_by_category($article)
    {
        $catIds = $article->category->pluck('id')->toArray();

        $related_articles = Article::query()->whereHas('category', function ($query) use ($catIds) {
            return $query->whereIn('category.id', $catIds);
        })->where('id', '!=', $article->id)
        ->limit(10)
            ->get();
        if($related_articles->isEmpty()){
            $related_articles=Article::query()->limit(5)->where("id","!=",$article->id)->get();
        }
        return $related_articles;
    }

    public static function find_by_slug($slug)
    {
        return Article::query()->where("slug",$slug)->firstOrFail();
    }

    public static function find($id)
    {
        return Article::findOrFail($id);
    }

    public static function order_article($order="asc",$name=null)
    {
            $order=$order==null ? "asc" : $order;
            $articles=Article::query();
            if($name){
                $articles=$articles->where("title","LIKE","%".$name."%");
            }
            switch ($order){
                case "asc":
                    $articles = $articles->orderByDesc("created_at")->paginate(10);
                    break;
                case "desc":
                    $articles = $articles->orderBy("created_at")->paginate(10);
                    break;
                case "name":
                    $articles = $articles->orderBy("title")->paginate(10);
                    break;
            }

        return $articles;
    }
    public static function like($name=null,$limit=10)
    {
        $articles=collect();
        if($name){
          $articles=Article::query()->where("title","LIKE","%".$name."%")->limit($limit)->get();
        }


        return $articles;
    }

    public static function create($data)
    {
        $article=Article::create([
            "title"=>$data->title,
            "user_id"=>$data->user_id,
            "media_id"=>$data->thumbnail,
            "content"=>$data->contents,
            "post_excerpt"=>$data->excerpt,

            "slug"=>$data->slug
        ]);
        return $article;
    }

    public static function update(Article $article,$data)
    {
        $article->update([
            "title"=>$data->title,
            "user_id"=>$data->user_id,
            "media_id"=>$data->thumbnail,
            "content"=>$data->contents,
            "post_excerpt"=>$data->excerpt,
            "slug"=>$data->slug
        ]);
    }



    public static function destroy($id)
    {
        return Article::destroy($id);
    }

    public static function create_article_category(Article $article,$category)
    {
        foreach ($category as $catId){

            $cat= Category::findOrFail($catId);
            $cat->articles()->save($article);
        }

    }

    public static function create_article_tag(Article $article,$tag)
    {
        foreach ($tag as $catId){
            $cat=Tag::findOrFail($catId);
            $cat->articles()->save($article);
        }

    }

    public static function get_all_category($type="article")
    {
        return Category::where("type",$type)->get();
    }

    public static function get_all_tag()
    {
        return Tag::get();
    }

    public static function get_article_category(Article $article)
    {
        return $article->category()->pluck("category_id")->toArray();
    }
    public static function get_article_tag(Article $article)
    {
       return $article->tags()->pluck("tag_id")->toArray();
    }


    public static function destroy_article_category(Article $article)
    {
        $article->category()->detach();
    }
    public static function destroy_article_tag(Article $article)
    {
        $article->tags()->detach();
    }



}
