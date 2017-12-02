<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


class AdminUsersController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware(function($request, $next){

            abort_unless($request->user()->can('superadmin'), 403);
            return $next($request);
        });

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' =>'required|unique:users|min:6',
            'email' =>'required|email',
            'password' => 'required|confirmed|min:6',

            'role' =>'required',
        ]);

        User::create(['name'=> request('name'), 'email' => request('email'),
            'password'=> bcrypt(request('password')), 'role'=> request('role'), 'remember_token' => str_random(100) ]);

        return redirect('/admin/users/succeeded')->with('status', 'User Created!');
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
    public function edit(User $user)
    {
        return  view('admin.users.edit', compact('user'));
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
            'name' =>'required|min:6',
            'email' =>'required|email',

            'role' =>'required',
        ]);

        if($request->password){
            $this->validate($request, [
                'password' => 'required|confirmed|min:6',
            ]);
        }


       User::where('id', $id)
           ->update(['name'=> request('name'), 'email' => request('email'), 'role'=> request('role')]);

        if($request->password){
            User::where('id', $id)
                    ->update(['password'=>bcrypt($request->password)]);
        }

        return redirect('/admin/users/succeeded')->with('status', 'User Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!env('APP_DEBUG')){
             User::destroy($id);
        }

        return redirect('/admin/users/succeeded')->with('status', 'User deleted!');

    }

    public function showConfirmWindow()
    {
        return view('admin.modal.deleteUser');
    }
}
