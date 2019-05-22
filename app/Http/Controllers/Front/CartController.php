<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Requests\AddCartRequest;
use App\Http\Controllers\Controller;
use App\Services\CartService;


class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cartItems = $this->cartService->get();
        $addresses = $request->user()->addresses()->orderBy('last_used_at', 'desc')->get();
        return view('front.cart.index', ['cartItems' => $cartItems, 'addresses' => $addresses]);

    }

   public function add(AddCartRequest $request){

        $this->cartService->add($request->input('sku_id'), $request->input('amount'));
        return [];
   }

   public function remove($id){
        $this->cartService->remove($id);
        return [];
   }
}
