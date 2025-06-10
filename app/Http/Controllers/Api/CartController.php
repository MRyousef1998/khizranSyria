<?php

namespace App\Http\Controllers\Api;


use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function add_item_to_cart(Request $request)
    {
        $cart=  Cart::create([
            'user_id' => $request->user_id,
            'product_details_id' => $request->product_details_id,

            
        ]);
        return response()->json([
            'message' => 'item successfully added to cart',
            'cart' => $cart
        ], 201);

    }
    public function remove_item_from_cart(Request $request)
    {
        $cart= Cart::where('user_id',$request->user_id)->where('product_details_id',$request->product_details_id)->where('order_app_id',0)->first()->delete();
        return response()->json([
            'message' => 'item successfully removed to cart',
            'isremoved' => $cart
        ], 201);
    }

    public function get_cart_count_item(Request $request)
    {
        $cartCount= Cart::where('user_id',$request->user_id)->where('product_details_id',$request->product_details_id)->where('order_app_id',0)->get()->count();
        return response()->json([
            'data' => [
                "itemCount"=>$cartCount]
        ], 201);
    }
    public function get_cart_item(Request $request)
    {

        $cart_itemes =DB::table('carts')->where('user_id',$request->user_id)->where('order_app_id',0)-> Join('product_details', 'product_details.id', '=', 'carts.product_details_id')
        ->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->selectRaw('product_details.id as product_detailes_id,count(product_details.id) as count,company_name,product_name,group_name,country_of_manufacture,product_details.image_name,product_details.rate,product_details.online_price') 
        ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name','product_details.rate','product_details.online_price')->get();
     return response()->json([
            'message' => 'cart itemes get successfully ',
            'cartItem' => $cart_itemes
        ], 201);}

}
