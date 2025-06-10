<?php


namespace App\Http\Controllers\Api;


use App\Models\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\OrderApp;


class OrderAppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
    }


    public function app_order_get_detailes(Request $request)
    {
        $cart_itemes =DB::table('carts')->where('user_id',$request->user_id)->where('order_app_id',$request->order_id)-> Join('product_details', 'product_details.id', '=', 'carts.product_details_id')
        ->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->selectRaw('product_details.id as product_detailes_id,count(product_details.id) as count,company_name,product_name,group_name,country_of_manufacture,product_details.image_name,product_details.rate,product_details.online_price') 
        ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name','product_details.rate','product_details.online_price')->get();
        
        $orderApp =DB::table('order_apps')->where('order_apps.id',$request->order_id)->first();
        $shipingAddress =DB::table('addresses')->where('id',$orderApp->address_id)->get();
   
   
   
        return response()->json([
            'message' => 'cart itemes get successfully ',
            'cartItem' => $cart_itemes,
            'shipingAddress'=>$shipingAddress
        ], 201);
    
    
    
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
      

        $orderApp=  OrderApp::create([
            'user_id' => $request->user_id,
            'address_id' => $request->address_id,
            'delevery_type' => $request->delevery_type,
            'peyment_mathodes' => $request->peyment_mathodes,

            'price_delevery' => $request->price_delevery,
            'order_price' => $request->order_price,
            'discount'=>$request->discount,

            
        ]);

        $carts= Cart::where('user_id',$request->user_id)->where('order_app_id',"0")->get();
        foreach($carts as $cart){
            $cart ->update([
                'order_app_id' => $orderApp->id,
            
            ]);

        }
       
        return response()->json([
            'message' => 'item successfully added to order',
            'order' => $orderApp
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderApp  $orderApp
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        
        $orderApp= OrderApp::where('user_id',$request->user_id)->get();
        return response()->json([
            'message' => 'successfully',
            'orderApp' => $orderApp
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderApp  $orderApp
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderApp $orderApp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderApp  $orderApp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderApp $orderApp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderApp  $orderApp
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderApp $orderApp)
    {
        //
    }
}
