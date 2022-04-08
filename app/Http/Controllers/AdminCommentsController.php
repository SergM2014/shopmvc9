<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class AdminCommentsController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware(function($request, $next){

            abort_unless($request->user()->can('admin'), 403);
            return $next($request);
        });
    }

    private function findOutOrder()
    {
        switch (\request('order')){
            case 'newFirst':
                $field = 'created_at'; $order = 'DESC';
                break;
            case 'oldFirst':
                $field = 'created_at'; $order = 'ASC';
                break;
            case 'name AZ':
                $field = 'name'; $order = 'DESC';
                break;
            case 'name ZA':
                $field = 'name'; $order = 'ASC';
                break;

            default:
                $field = 'name'; $order = 'DESC';
        }
        return [$field, $order];
    }

    public function index()
    {
        $orderVariables = $this->findOutOrder();
        $comments = Comment::orderBy(...$orderVariables)->paginate(10);
       // $comments = Comment::orderBy(...$orderVariables)->with('product')->paginate(10);

        return view('admin.comments.index', compact('comments'));
    }

    public function create()
    {
        return view('admin.comments.create');
    }

    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('admin.comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|email',
            'comment'=>'required'
        ]);

        Comment::where('id', $id)->update(['name' => request('name'), 'email' => request('email'),
            'comment'=>request('comment'), 'avatar'=> request('imagesData')]);

        return redirect('/admin/comments/succeeded')->with('status', 'Comment Updated!');
    }

    public function destroy($id)
    {
        Comment::destroy($id);
        return redirect('/admin/comments/succeeded')->with('status', 'Comment deleted!');
    }


    public function publish($id)
    {
        $comment = Comment::find($id);
        $comment->published = "1";
        $comment->save();
        return response()->json([
            'id' => $id,
            'message' => 'Comment is published!',
            'success' => true
        ]);
    }

    public function unpublish($id)
    {
        $comment = Comment::find($id);
        $comment->published = "0";
        $comment->save();
        return response()->json([
            'id' => $id,
            'message' => 'Comment is unpublished!',
            'success' => true
        ]);
    }


    public function showConfirmWindow()
    {
        return view('admin.modal.deleteComment');
    }

}
