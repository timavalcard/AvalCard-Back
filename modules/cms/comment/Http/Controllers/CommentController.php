<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 9/1/2020
 * Time: 2:13 PM
 */

namespace CMS\Comment\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use CMS\Comment\Http\Requests\CommentRequest;
use CMS\Comment\Models\Comment;
use CMS\Comment\Repository\CommentRepository;
use CMS\Common\Services\CommonService;

class CommentController extends Controller
{
    // theme functions

    public function add(Request $request)
    {
        $name=$request->name;
        $email=$request->email;
        if(auth()->check()){
            $name =auth()->user()->name;
            $email =auth()->user()->email;
        }
        $request->request->add(["name"=>$name,"email"=>$email]);
        $comment=CommentRepository::create($request,0);
        CommonService::tel_bot("comment_add",$comment->commentable->title,$comment->type);
        toastMessage();
        return back();
    }

    // admin functions
    public function article_comments(Request $request){
        $this->authorize("index",Comment::class);
        $comments=CommentRepository::order_comment($request->orderBy,"article");
        return view("Comment::Admin.article_list_comment",["comments"=>$comments]);
    }
    public function product_comments(Request $request){
        $this->authorize("index",Comment::class);
        $comments=CommentRepository::order_comment($request->orderBy,"product");
        return view("Comment::Admin.product_list_comment",["comments"=>$comments]);
    }
    public function product_questions(Request $request){
        $this->authorize("index",Comment::class);
        $comments=CommentRepository::order_comment($request->orderBy,"product","question");
        return view("Comment::Admin.product_list_comment",["comments"=>$comments]);
    }
    public function delete_comment($id)
    {
        $this->authorize("delete",Comment::class);
        CommentRepository::destroy($id);
        return back();
    }
    public function unAprrovedComment($ids){
        $this->authorize("unAprrove",Comment::class);
        if(is_array($ids)){
            $comments=CommentRepository::whereIn($ids);
        } elseif(is_int($ids)) {
            $comments=CommentRepository::find($ids);
        }
        foreach($comments as $comment){
            CommentRepository::update_comment_to_unApprove($comment);
        }
        return back();
    }

    public function arrovedComment($ids){
        $this->authorize("aprrove",Comment::class);
        if(is_array($ids)){
            $comments=CommentRepository::whereIn($ids);
        } elseif(is_int($ids)) {
            $comments=CommentRepository::find($ids);
        }

        foreach($comments as $comment){
            CommentRepository::update_comment_to_Approve($comment);
        }
        return back();
    }

    public function changeState_comment($id)
    {
        $this->authorize("changeState",Comment::class);
        $comment=CommentRepository::find($id);
        CommentRepository::change_state($comment);
        return back();
    }

    public function answer_comment_form($id){
        $this->authorize("answer",Comment::class);
        $comment=CommentRepository::find($id);
        return view("Comment::Admin.answer_comment",["comment"=>$comment]);
    }

    public function answer_comment(CommentRequest $request)
    {
        $this->authorize("answer",Comment::class);
        CommentRepository::create($request,1);

        return redirect()->route($request->post_type."_comments.index");
    }

    public function edit_comment_form($id){
        $this->authorize("edit",Comment::class);
        $comment=CommentRepository::find($id);
        return view("Comment::Admin.edit_comment",["comment"=>$comment]);
    }

    public function edit_comment (CommentRequest $request)
    {

        $this->authorize("update",Comment::class);
        $comment=CommentRepository::find($request->id);

       CommentRepository::update($comment,$request);

        return redirect()->route($request->post_type."_comments.index");
    }
}
