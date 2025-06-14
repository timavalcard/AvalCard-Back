<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 9/1/2020
 * Time: 2:37 PM
 */

namespace CMS\Comment\Repository;


use CMS\Comment\Models\Comment;

class CommentRepository
{
    public static function find($id)
    {
        return Comment::findOrFail($id);
    }
    public static function order_comment($order="all",$type="article",$comment_type="comment")
    {
        $order=$order==null ? "all" : $order;
        switch ($order){
            case "all":
                $comments = Comment::query()->where("parent_id",0)->where("type",$comment_type)->where("comment_able_type",$type)->orderByDesc("created_at")->paginate(10);
                break;
            case "unapproved":
                $comments = Comment::query()->where("parent_id",0)->where("type",$comment_type)->where("comment_able_type",$type)->where("status",0)->orderByDesc("created_at")->paginate(10);
                break;
            case "approved":
                $comments = Comment::query()->where("parent_id",0)->where("type",$comment_type)->where("comment_able_type",$type)->where("status",1)->orderByDesc("created_at")->paginate(10);
                break;
        }

        return $comments;
    }

    public static function destroy($id)
    {
        Comment::destroy($id);
    }

    public static function whereIn($ids)
    {
        return Comment::whereIn("id",$ids)->get();
    }

    public static function update_comment_to_unApprove(Comment $comment)
    {
        $comment->update([
            "status"=>false,

        ]);
    }

    public static function update_comment_to_Approve(Comment $comment)
    {
        $comment->update([
            "status"=>true,

        ]);
    }

    public static function change_state(Comment $comment)
    {
        $comment->update([
            "status"=>!$comment->status,

        ]);
    }


    public static function create($data,$status=0)
    {
        return Comment::create([
            "post_type"=>$data->post_type,
            "text"=>$data->text,
            "email"=>$data->email,
            "name"=>$data->name,
            "user_id"=>$data->user_id??null,
            "parent_id"=>$data->parent_id,
            "comment_able_id"=>$data->post_id,
            "comment_able_type"=>$data->post_type,
            "type"=>$data->type,
            "status"=>$status
        ]);
    }

    public static function update(Comment $comment,$data)
    {
        $comment->update([
            "text"=>$data->text,
            "email"=>$data->email,
            "name"=>$data->name,
        ]);
    }

    public static function get_unAprove_coment_count()
    {
        return Comment::where("status",0)->count();
    }

    public static function get_approve_comment($post,$type="comment")
    {
        return $post->comments()->where("type",$type)->where("status",1)->where("parent_id",0)->with(["children"=>function ($query){
            $query->where("status",1);
        }])->get();
    }
    public static function get_newest_comments()
    {
        return Comment::query()->orderByDesc("created_at")->limit(7)->get();
    }
}
