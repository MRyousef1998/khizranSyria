<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductCompany;
use App\Models\ProductDetail;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SmallShopController extends Controller
{
    public function index()
    { 
       
       
        $orders = Order::where('category_id','=',3)->get();
      
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

       

        return view('shop.shop_orders',compact('orders','exporter', 'importer','representative'));
    }
    public function store(Request $request)
    {
       
        $products=json_decode($request->my_hidden_input);
    
      

        if($products == null){
            session()->flash('Erorr', 'يرجى اختيار منتاجات هذه الطلبية');
            //  return $request;
              return redirect('add_shop_order');
        }
       
       
        
        
            Order::create([
             'order_date' =>  Carbon::today(),
             'order_due_date' =>  Carbon::today(),
             
             'exported_id' => $request->importer,
            
             'statuses_id' =>6,

             'related_to_id' =>$request->orderID,

             'category_id' => 3,
             'Amount_Commission' => 0,
             'Value_VAT' => 0,

             'Total' =>0,



     
         ]);
     // move pic
     $order_id = Order::latest()->first()->id;
     
    
     $totalPrice=0;
    
     foreach($products as $product)
     
     { 
         
         for($i=0 ;$i<$product->qty;$i++ ){
       
         $allProducts =Product::where("product_details_id", $product->id)->where("selling_date", null) ->get();
         
         $Olderproduct=Product::where("product_details_id", $product->id)->where("selling_date", null) ->first();
         $importOrderOldProdect=$Olderproduct->order()->get();
         $olderdate=$importOrderOldProdect[0]->order_due_date;
         $olderProductId=$Olderproduct->id;
         foreach($allProducts as $currentProduct){
             $importOrdeForCurrentProdect=$currentProduct->order()->get();
         $currentdate=$importOrdeForCurrentProdect[0]->order_due_date;
         if($olderdate>$currentdate)
         {
             $olderdate=$currentdate;
             $Olderproduct=$currentProduct;
             $olderProductId=$currentProduct->id;
         }
         
        
         }
         $Olderproduct->update([
            'selling_date' => Carbon::today(),
            'selling_price' =>  $Olderproduct->price_with_comm	,
            'selling_price_with_comm' => $Olderproduct->price_with_comm,

    
    
            ]);
            $totalPrice=$totalPrice+ $Olderproduct->price_with_comm;
         $Olderproduct->order()->attach($order_id);


       
 
       }
    
    }
         $order=Order::find($order_id) ;
         $order->update(['Total'=>$totalPrice]);

     
    session()->flash('Add', ' تم اضافة الطلبية ');
    return redirect('add_shop_order');
           
        
     

        return json_decode($request->my_hidden_input);
    }

    public function create1()
    {
       


        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

        $parts =DB::table('products')->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id", 3)->where("products.selling_date", null)->where("products.statuses_id",'!=',7)
        ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
        ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();

       
       

        return view('shop.add_shop_order',compact('parts','exporter', 'importer','representative'));
    }

    public function exporterOrders($id)
    {
     
       
        $orders = Order::where('exported_id','=',$id)->get();
      
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

       

        return view('order.export_order.exports_order',compact('orders','exporter', 'importer','representative'));
    }
    public function getOrder($id)
    {
       
//         $order = DB::table('orders')->where("exported_id", $id)
// ->select('id')
// ->distinct()
// ->pluck("id",);
        $order = DB::table("orders")->where("exported_id", $id)->pluck("order_date", "id",);
        return json_encode($order);
    }

    public function getDetailsOrder($id)
    { 

        $order=Order::find($id); 
        
        $detail=OrderDetail::where("orders_id",$id);
      
       $parts =DB::table('products')->
       leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
       ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id", $id)->where("product_details.category_id", 3)
       ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
       ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
      
       $exporter = User::where('role_id','=',1)->get();
            $importer = User::where('role_id','=',2)->get();
            $representative = User::where('role_id','=',3)->get();

        return view('shop.details_shop_order',compact('order','parts','exporter', 'importer','representative','id'));

        
       

       

    }

}
