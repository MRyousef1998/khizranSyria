<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;


use App\Models\ProductCompany;
use App\Models\ProductGroup;
use App\Models\ProductCategory;
use App\Models\Product;


use App\Models\ProductDetail;


use App\Models\Status;
use Carbon\Carbon;

class InsaidOrderController extends Controller
{
    public function index()
    {
       
       
        //$orders = Order::where('category_id','=',2)->get();
      
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();
        $Statuses  = Status::whereBetween('id',[5,6])->get();
       

        return view('order.insaid_order.insaid_orders',compact('exporter','Statuses', 'importer','representative'));
    }

    public function insaid_order_serch(Request $request)
    {
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $Statuses  = Status::whereBetween('id',[5,6])->get();

        if($start_at==null){

            $orders = Order::where('order_date','<=',[$end_at])->where('category_id','=',4)->get();

        }
        else
        {
        $orders = Order::whereBetween('order_date',[$start_at,$end_at])->where('category_id','=',4)->get();

        }
        
        
      
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

       

        return view('order.insaid_order.insaid_orders',compact('start_at','Statuses','end_at','orders','exporter', 'importer','representative'));
    }

    public function create1()
    {
        $importClints = User::where('role_id','=',10)->get();
      //  $importClint = User::where('role_id','=',2)->get();
        $clients = User::where('role_id','=',3)->get();
        $productDetail = ProductDetail::all();
        $productCompanies = ProductCompany::all();
        $productCatgories= ProductCategory::all();
        $status= Status::whereBetween('id',[5,6])->get();
    
        $orders= Order::all();


        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

        $machines =DB::table('products')->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id')
         ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id", 1)->where("products.selling_date", null)->where("products.statuses_id",'!=',7)->where("products.statuses_id",'!=',8)->where("products.statuses_id",'!=',4)
        ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
        ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
       

        $grinder =DB::table('products')->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id", 2)->where("products.selling_date", null)->where("products.statuses_id",'!=',7)->where("products.statuses_id",'!=',8)
        ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
        ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
        $parts =DB::table('products')->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id", 3)->where("products.selling_date", null)->where("products.statuses_id",'!=',7)
        ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
        ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();

        $broken_machines =DB::table('products')->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id')
         ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id", 1)->where("products.selling_date", null)->where("products.statuses_id",'=',7)
        ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
        ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
       
       
        $broken_grinder =DB::table('products')->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id", 2)->where("products.selling_date", null)->where("products.statuses_id",'=',7)
        ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
        ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
       
       
        $machinesRenew =DB::table('products')->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id')
         ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id", 1)->where("products.selling_date", null)->where("products.statuses_id",'=',8)
        ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
        ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
       
        $grindersRenew =DB::table('products')->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id')
         ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id", 2)->where("products.selling_date", null)->where("products.statuses_id",'=',8)
        ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
        ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
       
       

        return view('order.insaid_order.add_insaid_order',compact('grinder','grindersRenew','parts','machines','machinesRenew','broken_machines','broken_grinder','importClints','clients','productDetail','status','exporter', 'importer','representative'));
    }

    public function store(Request $request)
    {
           
        
     
        $products=json_decode($request->my_hidden_input);
       
      
      

        
            Order::create([
             'order_date' => Carbon::today(),
             'order_due_date' => Carbon::today(),
             
             'exported_id' => $request->exporter,
             
             'statuses_id' => $request->status,

     
             'category_id' => $request->order_category,
             'Amount_Commission' => 0,
             'Value_VAT' => $request->Value_VAT,

             'Total' => $request->Total,



     
         ]);
     // move pic
     $order_id = Order::latest()->first()->id;
     
     ////
     if($products == null){


        $newInvoice =  Invoice::create([
            'invoice_Date' =>  Carbon::today(),
            'orders_id' => $order_id,
            
            'invoice_categories_id' => 2,
            
            'Amount_collection' =>0 ,
            'Discount' =>0 ,
            'Total' =>0 ,
            'Value_Status' =>3 ,
          
            'note' =>"" ,
    
    
    
        ]);
        session()->flash('Add', ' تم اضافة الطلبية بنجاح قم بإضاقة المنتجات وحرر الفاتورة');
             return redirect('ExportOrderDetails/'. $order_id);
    }
    
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
            'selling_price' => $product->price,
            'selling_price_with_comm' => $product->price,

    
    
            ]);
         $Olderproduct->order()->attach($order_id);


       
 
       }
    
    }
          

     
    session()->flash('Add', ' تم اضافة الطلبية  بنجاح يرجى تحرير الفاتورة');
    return redirect('add_invoices/'.'2'.'/'.$order_id);
           
        
     

        return json_decode($request->my_hidden_input);
    }

}
