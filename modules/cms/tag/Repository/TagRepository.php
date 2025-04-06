<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 8/28/2020
 * Time: 9:17 PM
 */

namespace CMS\Tag\Repository;


use CMS\Tag\Models\Tag;

class TagRepository
{
    public static function get_by_type($type="article")
    {
        return Tag::query()->where("type",$type)->orderByDesc("created_at")->get();
    }

    public static function find($id)
    {
        return Tag::findOrFail($id);
    }

    public static function create($data)
    {
        return Tag::create([
            "name"=>$data->name,
            "slug"=>$data->slug,
            "content"=>$data->contents,
            "type"=>$data->post_type
        ]);

    }

    public static function update(Tag $tag,$data)
    {
        $tag->update([
            "name"=>$data->name,
            "slug"=>$data->slug,
            "content"=>$data->contents,
            "type"=>$data->post_type
        ]);

    }

    public static function destroy($id)
    {
        Tag::destroy($id);
    }
    public static function get_all_tag(){
     return Tag::get();
    }
}
