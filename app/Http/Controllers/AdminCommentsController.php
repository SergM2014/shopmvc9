<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class AdminCommentsController extends Controller
{

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $orderVariables = $this->findOutOrder();

        $comments = Comment::orderBy(...$orderVariables)->paginate(10);
//dd($comments);
       // $comments = Comment::orderBy(...$orderVariables)->with('product')->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('admin.comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

    }

}
