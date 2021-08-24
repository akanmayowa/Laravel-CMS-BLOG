<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
   
    public function index()
    {
        return view('admin.tags.index')->with('tags', Tag::all());
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {

        $this->validate($request,
        ['tag' => 'required'] );
        Tag::create([
            'tag' => $request->tag
        ]);
        toastr()->success('Tag created Successfully !');
        return redirect()->route('tag.index');

    }


    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
         $tag = Tag::find($id);
         return view('admin.tags.edit')->with('tag', $tag); 

    }


    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'tag' => 'required'
        ]);

        $tag = Tag::find($id);
        $tag->tag = $request->tag;
        $tag->save();
        toastr()->success('updated tag successfully');
        return redirect()->route('tag.index');
    }

    public function destroy($id)
    {

        
        Tag::destroy($id);
        toastr()->success('deleted tag successfully');
        return redirect()->back();
    }
}
