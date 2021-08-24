<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function index(){
          return view('index')->with('title', Setting::first()->site_name)
          ->with('categories', Category::all()->take(6))
          ->with('first_post', Post::OrderBy('created_at', 'desc')->select('slug','featured','title','created_at')->get()->first())
          ->with('second_post', Post::OrderBy('created_at', 'desc')->take(3)->skip(1)->get())
          ->with('career', Category::find(1))
          ->with( 'tutorials', Category::find(9))
          ->with('settings', Setting::first());
    }

    public function singlepost($slug){

                    $post = Post::where('slug', $slug)->first();
                    $next_id = DB::table('posts')->select('id','slug' )->where('id', '>', $post->id)->min('id');
                    $previous_id = DB::table('posts')->select('id','slug')->where('id', '<', $post->id)->max('id');
                    return view('single')
                                        ->with('post', $post)
                                        ->with('title', $post->title)
                                        ->with('categories', Category::take(5)->get())
                                        ->with('settings', Setting::first())
                                        ->with('next', Post::find($next_id))
                                        ->with('prev', Post::find($previous_id))
                                        ->with('tags', Tag::all());

}



             public function category($id){

                $category = Category::find($id);
                return view('category')
                ->with('category', $category)
                ->with('title', $category->name)
                ->with('categories', Category::take(5)->get())
                ->with('settings', Setting::first());

             }
}



