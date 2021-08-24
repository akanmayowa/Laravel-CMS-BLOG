<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;




class ProfilesController extends Controller
{

    public function index()
    {
        return view('admin.users.profile')->with('user', Auth::user());
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {

       $this->validate($request, [
           'name' => 'required',
           'email' => 'required|email',
           'facebook' => 'required',
           'about' => 'required',
           'youtube' => 'required'
       ]);

         $user = Auth::user();
         if($request->hasFile('avatar'))
         {
            $avatar = $request->avatar;
            $avatar_new_name = time().$avatar->getClientOriginalName();
            $avatar->move('/uploads/avatars/'.$avatar_new_name);
            $user->profile->$avatar = '/uploads/avatars/'. $avatar_new_name;
            $user->profile->save();
         }

         $user->name = $request->name;
         $user->email = $request->email;
         $user->profile->facebook = $request->facebook;
         $user->profile->about = $request->about;
         $user->profile->youtube = $request->youtube;
         $user->profile->save();
        // $user->save();


         if($request->has('password'))
         {
              $user->password = bcrypt($request->password);

         }


         toastr()->success('created successfully');
         return redirect()->route('dashboard');

    }


    public function destroy($id)
    {




    }
}
