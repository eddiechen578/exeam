<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Product;
use App\Entities\ProductSkus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductSkusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productSkuses = ProductSkus::with('product')->latest()->get();

        return view('admin.productSkus.index')
             ->with('productSkuses', $productSkuses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();

        return view('admin.productSkus.create')
            ->with('products', $products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Product::find($request->product_id)->product_skuses()
                ->create($request->only('title', 'description', 'price', 'stock'));

        return redirect()->route('productSkuses.index')
                        ->with('success', '單品新增成功.');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Product_skus  $product_skus
     * @return \Illuminate\Http\Response
     */
    public function show(Product_skus $product_skus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entities\Product_skus  $product_skus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_skus = ProductSkus::find($id);

        return view('admin.productSkus.edit')
              ->with('product_skus', $product_skus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Product_skus  $product_skus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product_skus = ProductSkus::find($id);
        $product_skus->update($request->only('title', 'description', 'price', 'stock'));

        return redirect()->route('productSkuses.index')
                        ->with('success', '單品更新成功.'); ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Product_skus  $product_skus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductSkus::destroy($id);
        return redirect()->back()
            ->with('success', '單品刪除成功.');
    }
}
