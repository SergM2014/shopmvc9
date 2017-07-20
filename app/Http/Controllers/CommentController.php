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
            //'captcha' => 'required|captcha'
            'captcha' => 'required'
        ],
        //this is custom error message
        [
            'captcha' => 'put correct captcha',
        ]
            );


        Comment::create(['product_id'=> $request->product_id, 'avatar' =>$request->avatar, 'parent_id'=>$request->parent_id, 'email'=>$request->email,
             'comment'=>$request->comment, 'published'=>'0', 'changed' =>'0']);

        return response()->json([
            'message' => 'comment is added successfully',
            'success' => 'true',


        ]);
    }
}
