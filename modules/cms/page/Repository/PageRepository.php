<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 8/28/2020
 * Time: 10:19 PM
 */

namespace CMS\Page\Repository;


use CMS\Page\Models\Page;

class PageRepository
{
    public static function find($id)
    {
        return Page::findOrFail($id);
    }
    public static function get(){
        return Page::get();
    }
    public static function find_by_slug($slug)
    {
        return page::query()->where("slug",$slug)->firstOrFail();
    }
    public static function get_by_limit($limit=5){
        return Page::query()->limit($limit)->get();
    }
    public static function order_page($order="asc",$name=null)
    {
        $order=$order==null ? "asc" : $order;
        $pages=Page::query();
        if($name){
            $pages=$pages->where("title","LIKE","%".$name."%");
        }
        switch ($order){
            case "asc":
                $pages = $pages->orderByDesc("created_at")->paginate(10);
                break;
            case "desc":
                $pages = $pages->orderBy("created_at")->paginate(10);
                break;
            case "name":
                $pages = $pages->orderBy("title")->paginate(10);
                break;
        }

        return $pages;
    }

    public static function create($data)
    {
        return Page::create([
            "title"=>$data->title,
            "user_id"=>$data->user_id,
            "content"=>$data->contents,
            "post_excerpt"=>$data->excerpt,
            "slug"=>$data->slug
        ]);
    }

    public static function update(Page $page,$data)
    {
        $page->update([
            "title"=>$data->title,
            "user_id"=>$data->user_id,
            "content"=>$data->contents,
            "post_excerpt"=>$data->excerpt,
            "slug"=>$data->slug
        ]);
    }

    public static function destroy($id)
    {
        Page::destroy($id);
    }
}
