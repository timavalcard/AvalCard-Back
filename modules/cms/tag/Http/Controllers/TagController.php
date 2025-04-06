<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 8/28/2020
 * Time: 9:16 PM
 */

namespace CMS\Tag\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CMS\Tag\Http\Requests\AddTagRequest;
use CMS\Tag\Http\Requests\EditTagRequest;
use CMS\Tag\Models\Tag;
use CMS\Tag\Repository\TagRepository;

class TagController extends Controller
{
    public function tag_add_form(Request $request){
        $this->authorize("index",Tag::class);
        if(!in_array($request->post_type,Tag::$post_type)){
            return abort(404);
        }

   $tags=TagRepository::get_by_type($request->post_type);
        return view("Tag::Admin.tag_add",["tags"=>$tags]);
    }

    public function tag_add(AddTagRequest $request)
    {
        $this->authorize("create",Tag::class);
        $slug=make_slug_for_data($request->name,$request->slug);
        $request->request->add(["slug"=>$slug]);
        $tag=TagRepository::create($request);
        if($request->ajax()){
            return $tag;
        } else {
            return back();
        }

    }

    public function tag_edit_form(Request $request,$id)
    {
        $this->authorize("edit",Tag::class);
        if(!in_array($request->post_type,Tag::$post_type)){
            return abort(404);
        }
        $tag=TagRepository::find($id);
        return view("Tag::Admin.tag_edit",["tag"=>$tag]);
    }

    public function tag_edit(EditTagRequest $request){
        $this->authorize("edit",Tag::class);
        $slug=make_slug_for_data($request->name,$request->slug);
        $request->request->add(["slug"=>$slug]);
        $tag=TagRepository::find($request->id);
        TagRepository::update($tag,$request);
        return back();
    }

    public function tag_delete($id)
    {
        $this->authorize("delete",Tag::class);
        TagRepository::destroy($id);
        return back();
    }

}
