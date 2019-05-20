<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Category;
use App\Entities\Product;
use App\Entities\Featured;
use File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:administrator', ['only' => 'create', 'edit', 'destroy']);
    }

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
        $categories = Category::all();
        return view('admin.product.create')
              ->with('categories', $categories);
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
           'category_id' => $request->category_id,
           'description' => $request->description,
           'price' => $request->price,
           'on_sale' => (int)$request->on_sale
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
       $categories = Category::all();
       return view('admin.product.edit')
             ->with('product', $product)
             ->with('categories', $categories);
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
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->on_sale = (int)$request->on_sale;

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
        return redirect()->route('products.index')
            ->with('success', '商品刪除成功.');;
    }

    public function productDetail(Request $request){

        $product_id = $request->product_id;

        $product = Product::find($product_id);

        $img_name = $product->featureds[0]->name;

        $category_name = $product->category->name;

        $product_detail = [
              'product_name' => $product->name,
              'img_name' => $img_name,
              'description'=> $product->description,
              'category_name' => $category_name,
              'on_sale' => $product->on_sale? '是': '否'
        ];

        return response()->json(['status' => $product_detail], 200);
    }

    public function trashed(){

        $products = Product::onlyTrashed()->get();

        return view('admin.product.trashed')
            ->with('products', $products);
    }

    public function kill($id){
        $products = Product::withTrashed()->where('id', $id)->first();
        $products->forceDelete();
        return redirect()->back()
        ->with('success', '商品刪除成功.');
    }

    public function restore($id){
        $products = Product::withTrashed()->where('id', $id)->first();
        $products->restore();
        return redirect()->back()
              ->with('success', '商品還原成功.');
    }
}
