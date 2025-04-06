<?php


namespace CMS\PostMeta\Repository;


use CMS\PostMeta\Models\Post_meta;

class PostMetaRepository
{

    public static function find_by_key($key,$metaableClass,$metaable="article")
    {
        return Post_meta::query()->whereHasMorph("metaable",$metaableClass, function($query) use($key,$metaable) {
            $query->where('meta_key', $key);
            $query->where('post_metaable_type',$metaable);
        }
        )->whereNotNull("meta_value");
    }

    public static function find_by_key_with_relation($key,$metaableClass,$metaable="article")
    {
        $post_meta=self::find_by_key($key,$metaable,$metaableClass);
        return $post_meta->with("metaable");
    }


    public static function limit_by_key($limit,$key,$metaable,$metaableClass)
    {
        $post_meta=self::find_by_key_with_relation($key,$metaable,$metaableClass);
        return $post_meta->limit($limit)->get()->pluck("metaable");
    }



    public static function update($id,$meta_name,$meta_value,$type=null)
    {
             $meta=update_post_meta($id,$meta_name,$meta_value,$type);
    }

    public static function update_meta_tag($id,$request)
    {
        PostMetaRepository::update($id,"meta_title",$request->meta_title);
        PostMetaRepository::update($id,"meta_description",$request->meta_description);
        PostMetaRepository::update($id,"meta_index",$request->meta_index);
        PostMetaRepository::update($id,"meta_follow",$request->meta_follow);
        PostMetaRepository::update($id,"keyword",$request->keyword??null);

    }

    public static function get_post_meta($id,$meta_name,$type=null){
        if(is_object($id)){

            $post=$id;

        }
        else if(is_int($id) && $type){
            $post=$type::find($id);
        }

        if($post){
            return $post->post_meta()->where("meta_key",$meta_name)->first();
        }
        return false;
    }

    public static function get_post_meta_value($id,$meta_name,$type=null)
    {
        $meta=self::get_post_meta($id,$meta_name,$type);
        if($meta){
            return $meta->meta_value;

        }
    }

    public static function limit_by_key_order_by_stock_number($limit,$key,$metaable,$metaableClass)
    {
        $post_meta=self::find_by_key_with_relation($key,$metaable,$metaableClass);
        $products=$post_meta->get()->pluck("metaable");
        $products=$products->filter(function($product){
            if(!$product->manage_stock || $product->stock_number){
                return $product;
            }
            return false;
        })->sortByDesc(function($product){
            return $product->stock_number;
        });
        // dd($products[0]->stock_number);
        return $products;
    }
}
