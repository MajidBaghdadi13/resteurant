<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $page_title='Category List';
        if (request('type')=='blog') {
            $categories=Category::where('type',1)->get();
        }else
        $categories=Category::where('type',0)->get();

        return view('category.index',compact('page_title','categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $page_title='Category Create';

        return view('category.create',compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'type'=>'required'
        ]);

        if ($request->hasFile('thumbnail')) {
            $image=$request->file('thumbnail');
            $path='/uploads/category/';
        }

        Category::create([
         'name'=>$request->name,
         'thumbnail'=>$request->hasFile('thumbnail')?UploadImage($image,$path):'',
         'type'=>$request->type,


        ]);



        return redirect()->route('category.index')->with('success', 'Ctegory Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $page_title='Category Edit';

        return view('category.edit',compact('page_title','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'=>'required',
            'type'=>'required'
        ]);

        if ($request->hasFile('thumbnail')) {
            $image=$request->file('thumbnail');
            $path='/uploads/category/';
            $old_path=$category->thumbnail;
        }

        $category->update([
         'name'=>$request->name,
         'thumbnail'=>$request->hasFile('thumbnail')?UploadImage($image,$path,$old_path):$category->thumbbnail,
         'type'=>$request->type,


        ]);
        if ($category->type==0) {

            return redirect(route('category.index').'?type=menu')->with('success', 'Ctegory Update Successfully!');
        }

        return redirect(route('category.index').'?type=blog')->with('success', 'Ctegory Update Successfully!');




    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (file_exists($category->thumbnail)) {

            unlink($category->thumbnail);
        }
    $category->delete();
    return back()->with('toast_success','Category Delete Succesfully');
    }
}
