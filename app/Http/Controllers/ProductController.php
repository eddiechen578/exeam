<?php

namespace App\Http\Controllers;

use App\Entities\Product;
use App\Entities\Featured;
use File;
use http\Env\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index')
              ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create([
           'name' => $request->name,
           'slug' => str_slug($request->name),
           'category_id' => $request->category_id,
           'description' => $request->description,
           'price' => $request->price,
        ]);

        return response()->json(['status' => $product->id], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entities\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
       return view('admin.product.edit')
             ->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, Request $request)
    {
        $product->name = $request->name;
        $product->slug = str_slug($request->name);
        $product->category_id = 1;
        $product->description = $request->description;
        $product->price = $request->price;

        $product->save();
        return response()->json(['status' => $product->id], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $delId = $product->id;
        $product->delete();
        Featured::where('product_id', $delId)->delete();
        File::deleteDirectory(public_path('upload/product_'.$delId));
        return redirect()->route('index');
    }
}
