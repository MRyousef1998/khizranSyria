<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;

use Illuminate\Http\Request;
use App\Models\ProductCompany;
use App\Models\ProductGroup;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\InvoicesDetails;

use App\Models\OrderDetail;
use App\Models\ProductDetail;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       
       
        $exporter = User::where('role_id','=',1)->get();
            $importer = User::where('role_id','=',2)->get();
            $representative = User::where('role_id','=',3)->get();
            $Statuses =Status::all();

       

        return view('order.import_order',compact('exporter', 'importer','representative','Statuses'));
    }


    public function  import_order_serch(Request $request)
    {
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);

        if($request->importer!=null){
            if($start_at==null){

                $orders = Order::where('order_date','<=',[$end_at])->where('category_id','=',1)
                ->where('exported_id','=',$request->importer)->get();
                
            }
            else
            {
            $orders = Order::whereBetween('order_date',[$start_at,$end_at])->where('category_id','=',1)
            ->where('exported_id','=',$request->importer)->get();
    
            }
        }
        else{
            if($start_at==null){

                $orders = Order::where('order_date','<=',[$end_at])->where('category_id','=',1)->get();
                
            }
            else
            {
            $orders = Order::whereBetween('order_date',[$start_at,$end_at])->where('category_id','=',1)->get();
    
            }
        }
       
        
        
      
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();
        $Statuses =Status::where('id','<',4)->get();
       

        return view('order.import_order',compact('start_at','Statuses','end_at','orders','exporter', 'importer','representative'));
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $importClints = User::where('role_id','=',2)->get();
      //  $importClint = User::where('role_id','=',2)->get();
        $clients = User::where('role_id','=',3)->get();
        $productDetail = ProductDetail::all();
        $productCompanies = ProductCompany::all();
        $productCatgories= ProductCategory::all();
     
        $orders= Order::all();

        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

       

        return view('order.add_import_order',compact('importClints','clients','productDetail','exporter', 'importer','representative'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $myCarancyMull=1;
          
        if($request->carency==2){
            $myCarancyMull=4.55;
            
            
              }
              else if($request->carency==3){
                $myCarancyMull=4.1;
                
              }
            
     
        $products=json_decode($request->my_hidden_input);
       
         

       
        if($request->pic==null){
            session()->flash('Erorr', 'يرجى ادخال ملف يوثق هذه الفاتورة');
            //  return $request;
              return redirect('add_order');
        }
        if($request->pic!=null){
            
  
      
       
            $imageName = $request->pic;
            $fileName = $imageName->getClientOriginalName();
        
            Order::create([
             'order_date' => $request->order_Date,
             'order_due_date' => $request->Due_date,
             
             'exported_id' => $request->importer,
             'representative_id' => $request->clint,
             'statuses_id' => $request->status,

             'image_name' => $fileName,

             'category_id' => $request->order_category,
             'Amount_Commission' => ($request->Amount_Commission)*$myCarancyMull,
             'Value_VAT' => ($request->Value_VAT)*$myCarancyMull,

             'Total' => ($request->Total)*$myCarancyMull,



     
         ]);
     // move pic
     $order_id = Order::latest()->first()->id;
     
     $request->pic->move(public_path('Attachments/' . $order_id ), $fileName);
     if($products == null){


        $newInvoice =  Invoice::create([
            'invoice_Date' =>  Carbon::today(),
            'orders_id' => $order_id,
            
            'invoice_categories_id' => $request->order_category,
            
            'Amount_collection' =>0 ,
            'Discount' =>0 ,
            'Total' =>0 ,
            'Value_Status' =>3 ,
          
            'note' =>"" ,
    
    
    
        ]);
        session()->flash('Add', ' تم اضافة الطلبية بنجاح قم بإضاقة المنتجات وحرر الفاتورة');
             return redirect('OrderDetails/'. $order_id);
    }
    
     foreach($products as $product)
     
        { for($d=0 ;$d<$product->qty;$d++ ){
            $newproduct =  Product::create([
                'product_details_id' => $product->id,
                'primary_price' =>( $product->price)*$myCarancyMull,
                'price_with_comm' =>( $product->commission_pice+$product->price)*$myCarancyMull,
                'selling_price' => ($product->commission_pice+$product->price)*$myCarancyMull,
                
                'statuses_id' =>$request->status ,
   
        
            ]);
            $newproduct->order()->attach($order_id);
    
          }}
    
     
          

      
         session()->flash('Add', ' تم اضافة الطلبية  بنجاح يرجى تحرير الفاتورة');
         return redirect('add_invoices/'.$request->order_category.'/'.$order_id);
           
        
     }

        return json_decode($request->my_hidden_input);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        $order_id=$request->order_id;
        $order=Order::findOrFail($request->order_id);
        $order_invoice=Invoice::where('orders_id',$order_id)->first();
        
       // $order_attechment=OrderAttachment::where('orders_id',$order_id);
        $order_detail=OrderDetail::where('orders_id',$order_id)->first();
        $order_payment=Payment::where('orders_id',$order_id)->first();
        $products =DB::table('products')->
       Join('order_product', 'products.id', '=', 'order_product.products_id')-> where('order_product.orders_id',$order_id)
       ->selectRaw('products.id')-> get();
   

        if ($order_invoice!=null) {
            $invoice_detail=InvoicesDetails::where('invoices_id',$order_invoice->id)->first();
            if ($invoice_detail!=null) {
        
                $invoice_detail->delete();                    
                                        
                                       }
            $order_invoice->delete();   
                        
                       }
      
         if ($order_detail!=null) {
        
            $order_detail->delete();                
                                    
                                   }                         

        if ($order_payment!=null) {
            $order_payment->delete();
          
            
           }


           foreach($products as $product){
            $productforDelete=Product::find($product->id);
            $productforDelete->order()->detach($order_id);
            $productforDelete ->update([
                'selling_date' => null,
                'box_id' => null,
            ]);
           
           }
           $order->delete();

           session()->flash('Add', 'تم تحديث الحذف  بنجاح');
           return redirect('export_order');
    }
    public function order_prodect_code($order_id)
    {
       
        $productCategories = ProductCategory::all();
        $statuses = Status::where('id','1=',5)->where('id','1=',6)->get();
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

$order=Order::find($order_id);

        return view('order.order_product_code',compact('statuses',"productCategories",'exporter', 'importer','representative','order'));
  
    
    }

    public function order_prodect_code_serch(Request $request)
    {
        
        $typeSeleingId=null;
        $typeSeleingName=null;
       
    
        $statuses = Status::where('id','!=',5)->where('id','!=',6)->get();

        if($request->selling_status==null&& $request->status==null){
            $machines =DB::table('products')->
            leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
            leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->
            leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
            ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id')
            ->leftJoin('boxes', 'products.box_id', '=','boxes.id') ->
          
            Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("order_product.orders_id", $request->order_id)
            ->get();
           
            
        }
      else if($request->selling_status!=null&& $request->status==null){
        if($request->selling_status==1){
            $machines =DB::table('products')->
            leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
            leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->
            leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
            ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id')
            ->leftJoin('boxes', 'products.box_id', '=','boxes.id') ->
          
            Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("order_product.orders_id", $request->order_id)
            ->where("products.selling_date", '=',null)->get();
           
            $typeSeleingId=1;
                $typeSeleingName='غیر مباع';
        }
        else{
            $machines =DB::table('products')->
            leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
            leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->
            leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
            ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id')
            ->leftJoin('boxes', 'products.box_id', '=','boxes.id') ->
          
            Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("order_product.orders_id", $request->order_id)
            ->where("products.selling_date", '!=',null)->get();
           
            $typeSeleingId=2;
                $typeSeleingName=' مباع';
        }
        
    }
    else if($request->selling_status==null&& $request->status!=null){
      
            $machines =DB::table('products')->
            leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
            leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->
            leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
            ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id')
            ->leftJoin('boxes', 'products.box_id', '=','boxes.id') ->
          
            Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("order_product.orders_id", $request->order_id)
            ->where("statuses.id", '=',$request->status)->get();
           
            
        }  
        else if($request->selling_status!=null&& $request->status!=null){
            if($request->selling_status==1){
                $machines =DB::table('products')->
                leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
                leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->
                leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
                ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id')
                ->leftJoin('boxes', 'products.box_id', '=','boxes.id') ->
              
                Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("order_product.orders_id", $request->order_id)
                ->where("products.selling_date", '=',null)->where("statuses.id", '=',$request->status)->get();
                $typeSeleingId=1;
                $typeSeleingName='غیر مباع';
                
            }
            else{
                $machines =DB::table('products')->
                leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
                leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->
                leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
                ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id')
                ->leftJoin('boxes', 'products.box_id', '=','boxes.id') ->
              
                Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("order_product.orders_id", $request->order_id)
                ->where("products.selling_date", '!=',null)->where("statuses.id", '=',$request->status)->get();
                $typeSeleingId=2;
                $typeSeleingName=' مباع';
                
            }
           
            
        }
    
        




               $productCategories=ProductCategory::where("id",'!=',$request->productCatgory)->get();
             
               $typeproductCatgories=ProductCategory::find($request->productCatgory);
               $typeStatus=Status::find($request->status);
               $id=$request->productCatgory;
                $exporter = User::where('role_id','=',1)->get();
                $importer = User::where('role_id','=',2)->get();
                $representative = User::where('role_id','=',3)->get();
               
               $order=Order::find($request->order_id);
                return view('order.order_product_code',compact('typeSeleingId','typeSeleingName','statuses','typeStatus','typeproductCatgories','order','machines','exporter', 'importer','representative','productCategories'));
                

    }

    public function create1()
    {
        $importClints = User::where('role_id','=',2)->get();
      //  $importClint = User::where('role_id','=',2)->get();
        $clients = User::where('role_id','=',3)->get();
        $productDetail = ProductDetail::all();
        $productCompanies = ProductCompany::all();
        $productCatgories= ProductCategory::all();
        $status= Status::where('id','<=',3)->where('id','!=',2)->get();
    
        $orders= Order::all();

        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

       

        return view('order.add_import_order1',compact('importClints','clients','productDetail','status','exporter', 'importer','representative'));
    }
    public function add_produ_from_order($id)
    { 
        
        $productDetail = ProductDetail::all();
        $productCompanies = ProductCompany::all();
        $productCatgories= ProductCategory::all();
        $orders= Order::where('id','=',$id)->get();
        $status=Status::all();

        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

       

        return view('my_product.add_product',compact('productCompanies','productCatgories','orders','status','exporter', 'importer','representative','orders'));
    }
    public function Status_Update(Request $request)
    { 
        
        $order = Order::findOrFail($request->order_id);

      

        $order->update([
            'statuses_id' => $request->status_id,
            'order_due_date'=> Carbon::today(),
        ]);


        session()->flash('Add', 'تم تحديث الحالة بنجاح');
        return redirect('home');
    
    }
    public function order_report($id)
    {
        

        $order=Order::find($id); 
         
        $payments=Payment::where("orders_id", $id)->where("representative_id", '=',null)->get() ; 
        
        $total_payments=Payment::where("orders_id", $id)->where("representative_id", '=',null)->selectRaw('sum(amount) as total')
        ->groupBy('orders_id')->get(); 
       
$allSold=DB::table('products')-> 
Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id", $id)->where("products.selling_date", '!=',null)
 ->selectRaw('order_product.orders_id,count(products.id) as number_sold ,sum(products.price_with_comm) as primery_price_with_com_product_sold,sum(products.selling_price) as selling_price_without_com_product_sold,sum(products.selling_price_with_comm) as selling_price_with_com_product_sold')
 ->groupBy('order_product.orders_id')->get();
     
 
 $machinesSold =DB::table('products')-> leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
        Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id", $id)->where("product_details.category_id", 1)->where("products.selling_date", '!=',null)
         ->selectRaw('order_product.orders_id,count(products.id) as number_sold ,sum(products.price_with_comm) as primery_price_with_com_product_sold,sum(products.selling_price) as selling_price_without_com_product_sold,sum(products.selling_price_with_comm) as selling_price_with_com_product_sold')
         ->groupBy('order_product.orders_id')->get();

          
 $GrinderSold =DB::table('products')-> leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
 Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id", $id)->where("product_details.category_id", 2)->where("products.selling_date", '!=',null)
  ->selectRaw('order_product.orders_id,count(products.id) as number_sold ,sum(products.price_with_comm) as primery_price_with_com_product_sold,sum(products.selling_price) as selling_price_without_com_product_sold,sum(products.selling_price_with_comm) as selling_price_with_com_product_sold')
  ->groupBy('order_product.orders_id')->get();
    


  $allRemining=DB::table('products')-> 
Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id", $id)->where("products.selling_date",'=',null)
 ->selectRaw('order_product.orders_id,count(products.id) as number_remining ,sum(products.price_with_comm) as primery_price_with_com_product_remining')
 ->groupBy('order_product.orders_id')->get();


 $machinesRemining =DB::table('products')-> leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
 Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id", $id)->where("product_details.category_id", 1)->where("products.selling_date", '=',null)
  ->selectRaw('order_product.orders_id,count(products.id) as number_remining ,sum(products.price_with_comm) as primery_price_with_com_product_remining')
  ->groupBy('order_product.orders_id')->get();

   
$GrinderRemining =DB::table('products')-> leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id", $id)->where("product_details.category_id", 2)->where("products.selling_date", '=',null)
 ->selectRaw('order_product.orders_id,count(products.id) as number_remining ,sum(products.price_with_comm) as primery_price_with_com_product_remining')
 ->groupBy('order_product.orders_id')->get();


 $smallShop = DB::table('products')-> leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
 Join('order_product', 'products.id', '=', 'order_product.products_id')->where("orders.category_id", 3)->leftJoin('orders', 'orders.id', '=', 'order_product.orders_id')->where("orders.related_to_id", $id)
  ->selectRaw('orders.related_to_id,count(products.id) as number ,sum(products.price_with_comm) as primery_price_with_com_productParts')
  ->groupBy('orders.related_to_id')->get();
 
 


  if ($allSold->isEmpty()==true) {

    $allSold=[new Request(['id'=>$id,

    "number_sold"=>0,
    "primery_price_with_com_product_sold"=>0,
    "selling_price_without_com_product_sold"=>0,
    "selling_price_with_com_product_sold"=>0,
])];
    
   }


   if ($machinesSold->isEmpty()==true) {

    $machinesSold=[new Request(['id'=>$id,

    "number_sold"=>0,
    "primery_price_with_com_product_sold"=>0,
    "selling_price_without_com_product_sold"=>0,
    "selling_price_with_com_product_sold"=>0,
])];
    
   }
   if ($GrinderSold->isEmpty()==true) {

    $GrinderSold=[new Request(['id'=>$id,

    "number_sold"=>0,
    "primery_price_with_com_product_sold"=>0,
    "selling_price_without_com_product_sold"=>0,
    "selling_price_with_com_product_sold"=>0,
])];
    
   }

 
  if ($allRemining->isEmpty()==true) {

    $allRemining=[new Request(['id'=>$id,

    "number_remining"=>0,
    "primery_price_with_com_product_remining"=>0,
])];
    
   }

   if ($machinesRemining->isEmpty()==true) {

    $machinesRemining=[new Request(['id'=>$id,

    "number_remining"=>0,
    "primery_price_with_com_product_remining"=>0,
])];
    
   }
   if ($GrinderRemining->isEmpty()==true) {

    $GrinderRemining=[new Request(['id'=>$id,

    "number_remining"=>0,
    "primery_price_with_com_product_remining"=>0,
])];
    
   }
   if ($smallShop->isEmpty()==true) {

    $smallShop=[new Request(['id'=>$id,

    "number"=>0,
    "primery_price_with_com_productParts"=>0,
])];
    
   }

   if ($total_payments->isEmpty()==true) {

    $total_payments=[new Request([
    "total"=>0,
])];
    
   }

  

  $exporter = User::where('role_id','=',1)->get();
  $importer = User::where('role_id','=',2)->get();
  $representative = User::where('role_id','=',3)->get();

      
  
          return view('order.order_report',compact('allRemining','smallShop','GrinderRemining','GrinderSold',
        'total_payments',  'payments','machinesSold','machinesRemining','order','exporter', 'importer','representative','allSold'));
  
          





    }

    

}
