<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.categories.index')->with('categories', Category::all());
    }

    public function create()
    {
        return view('admin.categories.create');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        toastr()->success('Data has been saved successfully!');
        return redirect()->back();

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        $category = Category::find($id);
        return view('admin.categories.edit')->with('category',$category );
    }


    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required'
        ]);
        $category = new Category();
        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();
        Session::flash('success','Category Updated');
        return redirect()->route('category.index');

    }

    public function destroy($id)
    {

       $category = Category::find($id);
       foreach($category->posts as $post)
       {
           $post->delete();
       }
       $category->delete();
       toastr()->success('Data has been deleted successfully!');
              return redirect()->route('category.index');
    }
}
