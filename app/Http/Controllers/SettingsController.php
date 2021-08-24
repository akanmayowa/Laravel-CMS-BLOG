<?php

namespace App\Http\Controllers;


use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Setting;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{


    public function __construct()
    {
           $this->Middleware('admin');
    }


    public function index(){

        return view('admin.settings.settings')->with('settings', Setting::first());
    }

    public function update()
    {
       $this->validate(request(), [

         'site_name' => 'required',
         'contact_email' => 'required',
         'address' => 'required',
         'contact_number' => 'required'

       ]);
       $settings = Setting::first();
       $settings->site_name = request()->site_name;
       $settings->contact_number = request()->contact_number;
       $settings->address = request()->address;
       $settings->contact_email = request()->contact_email;
       $settings->save();
       toastr()->success('blog Setting Updates');
       return view('dashboard');

    }

}
