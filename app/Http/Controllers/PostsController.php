<?php

namespace App\Http\Controllers;


use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
class PostsController extends Controller
{

    public function index()
    {
     return view('admin.posts.index')->with('posts', Post::all());

    }


    public function create()
    {
        $categories = new Category();
        $tag = Tag::all();

        if($categories->count() == 0 || $tag->count() == 0)
        {
            toastr()->info('create a category and tag first! ');
            return redirect()->back();
        }

        return view('admin.posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }


    public function store(Request $request)
    {
      $this->validate($request, [
        'title'=>'required|max:255',
        'featured' => 'required|image',
        'content' =>'required',
        'category_id' => 'required',
        'tags' => 'required'

        ]);


        $featured = $request->featured;
        $featured_new_name = time().$featured->getClientOriginalName();
        $featured->move('uploads/posts', $featured_new_name);


         $post = Post::create([
           'title' => $request->title,
           'featured' => 'uploads/posts/'. $featured_new_name,
           'content' => $request->content,
           'category_id' => $request->category_id,
           'slug' => Str::slug($request->title)
       ]);

       $post->tags()->attach($request->tags);
       toastr()->success('Data has been saved successfully!');
       return redirect()->back();


    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $post = new Post();
        $post = Post::find($id);
        return view('admin.posts.edit')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());

    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [

             'title' => 'required',
             'content' => 'required',
             'category_id' => 'required',
             'tags' => 'required'

        ]);
        $post = Post::Find($id);
        if($request->hasFile('featured'))
        {

            $featured = $request->featured;
            $featured_new_name = time().$featured->getClientOriginalName();
            $featured->move('uploads/posts'. $featured_new_name);
            $post->featured = 'uploads/posts/'.$featured_new_name;
        }
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->save();
        $post->tags()->sync($request->tags);
        toastr()->success('post successfully uploaded');
        return redirect()->route('post.index');


    }




    public function destroy($id)
    {

        $post = Post::find($id);
        $post-> delete();
        toastr()->success('Data has been trashed successfully!');
        return redirect()->back();

    }

    public function trashed(){
        $post = Post::onlyTrashed()->get();
        return view('admin.posts.trashed')->with('posts', $post);
        dd($post);
    }

    public function kill($id){
        $post = Post::withTrashed()->where('id',$id)->first();
        $post->forceDelete();
        toastr()->success('Data has been deleted permanently successfully!');
        return redirect()->back();
    }


    public function restore($id){

        $post = new Post();
        $post = Post::withTrashed()->first();
        $post->restore();
        toastr()->success('Restored post successful');
        return redirect()->route('post.index');
    }
}
