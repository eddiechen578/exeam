<?php

namespace App\Http\Controllers\Front;

use App\Entities\OrderItem;
use App\Exceptions\InvalidRequestException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Product;

class MerchandiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $builder = Product::where('on_sale', 1);

        if($serach = $request->input('search', '')){
            $like = "%$serach%";
            $builder->where(function ($query) use ($like){
                $query->where('name', 'like', $like)
                      ->orWhere('description', 'like', $like)
                      ->orWhereHas('product_skuses', function ($query) use ($like){
                          $query->where('name', 'like', $like)
                                ->orWhere('description', 'like', $like);
                      });
            });
        }

        if($orderby = $request->input('orderby', '')){
            if(preg_match('/^(.+)_(asc|desc)$/', $orderby, $m)){
                if(in_array($m[1], ['price', 'sold_count', 'rating'])){
                    $builder->orderBy($m[1], $m[2]);
                }
            }
        }

        $products = $builder->paginate(16);

        return view('Front.merchandise.index', [
            'products' => $products,
            'filters'  => [
                'search'  => $serach,
                'orderby' => $orderby
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $product = Product::find($id);
        if(!$product->on_sale) {
            throw new InvalidRequestException('商品未上架.');
        }

        $favored = false;

        if($user = $request->user()){
            $favored = (boolean)$user->favoriteProducts()->find($product->id);
        }

        $reviews = OrderItem::with(['order.user', 'productSku'])
                ->where('product_id', $product->id)
                ->whereNotNull('reviewed_at')
                ->orderBy('reviewed_at', 'desc')
                ->limit(10)
                ->get();
        return view('Front.merchandise.show',[
                'product' => $product,
                'favored' => $favored,
                'reviews' => $reviews
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
