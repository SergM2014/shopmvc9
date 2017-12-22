<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function add(Request $request)
    {
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|email',
            'comment'=>'required',
            'captcha' => 'required|captcha'
        ],
        //this is custom error message
        [
            'captcha' => trans('messages.captcha'),
        ]
            );


        Comment::create(['product_id'=> $request->product_id, 'avatar'=>$request->avatar, 'name'=> $request->name,
            'parent_id'=>$request->parent_id, 'email'=>$request->email, 'comment'=>$request->comment, 'published'=>'0',
            'changed' =>'0']);

        return response()->json([
            'message' => trans('messages.commentAddedSuccessfuly'),
            'success' => 'true',


        ]);
    }


    public function getCommentForResponse()
    {
      $commentId = \request('commentId');
        $comment= Comment::find($commentId);
        return view('custom.partials.showParentComment', compact('comment'));
    }
}
