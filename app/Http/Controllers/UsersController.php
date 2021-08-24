<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\profile;

class UsersController extends Controller
{


    public function __construct()
    {

         $this->middleware('admin');
    }


    public function index()
    {
        return view('admin.users.index')->with('users', User::all());
    }


    public function create()
    {
        return view('admin.users.create');
    }


    public function store(Request $request)
    {
        $this->validate($request,[

            'name' => 'required',
            'email' => 'required|email'
        ]);


        $user = User::Create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password')
        ]);

        $profile = profile::create([
            'user_id' => $user->id,
            'avatar' => 'uploads/avatars/1.png',
            'about' => 'lorem lorem',
            'facebook' => 'facebook.com',
            'youtube' => 'youtube.com'
        ]);

        toastr()->success('post successfully uploaded');
        return redirect()->back();

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        $user->profile->delete();

        toastr()->success('deleted successfully');
        return redirect()->back();

    }

      public function make_admin($id){

        $user = User::find($id);
        $user->admin = 1;
        $user->save();
        toastr()->success('admin user created');
        return redirect()->back();

      }


      public function notmake_admin($id){

        $user = User::find($id);
        $user->admin = 0;
        $user->save();
        toastr()->success('non admin user created');
        return redirect()->back();

      }


}
