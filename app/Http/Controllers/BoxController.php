<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

     
        $prouct=Product::find($request->id);
        $box_id =$request->box_id;
        $prouct->update([
            'box_id' => $box_id,
    
            ]);
            if($request->capsalation_from==2){
                session()->flash('Add', 'تم التغليف بنجاح ');
                return redirect('export_order_prodect_code/'. $request->order_id);
            }
    
             session()->flash('Add', 'تم التغليف بنجاح ');
             return redirect('ExportOrderDetails/'. $request->order_id);
             
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   


    //     $product_id =DB::table('products')-> where("product_details_id", $request->id)->
    //     Join('order_product', 'products.id', '=', 'order_product.products_id')->
    //     where("order_product.orders_id", $request->order_id)->
    //    first();
     
    //    $prouct=Product::find($product_id->products_id);
    $prouct=Product::find($request->id);
    $order=Order::find($request->order_id);
    
     $box=  Box::create([
        'box_code' => $request->box_code,
    ]);
       $box_id = Box::latest()->first()->id;
    
        if($request->pic!=null){

            $imageName = $request->pic;
            $fileName = $imageName->getClientOriginalName();
     $request->pic->move(public_path('Attachments/Box/mybox' . $box_id ), $fileName);
            $box->update([
        'box_image_name' => $fileName,

        ]);
        
     }

     $prouct->update([
        'box_id' => $box_id,

        ]);
        $order->update([
            'statuses_id' => 5,
    
            ]);

            if($request->capsalation_from==2){
                session()->flash('Add', 'تم التغليف بنجاح ');
                return redirect('export_order_prodect_code/'. $request->order_id);
            }
    
         session()->flash('Add', 'تم التغليف بنجاح ');
         return redirect('ExportOrderDetails/'. $request->order_id);
         
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function show(Box $box)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function edit(Box $box)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Box $box)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Box  $box
     * @return \Illuminate\Http\Response
     */
    public function destroy(Box $box)
    {
        //
    }
     public function getBoxDetails(Request $request)
    {
         $detailBox =DB::table('products')->where("products.box_id", $request->box_id)->
         leftJoin('boxes', 'boxes.id', '=', 'products.box_id')->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
        leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->
        leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
         ->get();
         
        
       
         
     return view('shipment.details_box',compact('detailBox'));

    }
}
