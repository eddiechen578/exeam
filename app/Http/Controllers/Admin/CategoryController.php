<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\Controller;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index')
              ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $validate = $request->validated();
        $category = new Category();
        $category->name = $validate['name'];
        $category->slug = str_slug($validate['name']);
        $category->save();

        return redirect()->route('categories.index')
                        ->with('success', '類別新增成功.');
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
    public function edit(Category $category)
    {
        return view('admin.category.edit')
              ->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, CategoryRequest $request)
    {
        $category->name = $request->name;
        $category->slug = str_slug($request->name);
        $category->save();

        return redirect()->route('categories.index')
                        ->with('success', '類別更新成功.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()
            ->with('success', '類別刪除成功.');
    }

    public function trashed(){
        $categories = Category::onlyTrashed()->get();

        return view('admin.category.trashed')
              ->with('categories', $categories);
    }

    public function kill($id){
        $category = Category::withTrashed()->where('id', $id)->first();
        $category->forceDelete();
        return redirect()->back();
    }

    public function restore($id){
        $category = Category::withTrashed()->where('id', $id)->first();
        $category->restore();
        return redirect()->back();
    }
}
