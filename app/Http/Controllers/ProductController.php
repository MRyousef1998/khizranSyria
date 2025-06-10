<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoicesDetails;
use App\Models\Product;

use App\Models\Order;
use App\Models\ProductCategory;
use App\Models\ProductDetail;
use App\Models\OrderDetail;
use App\Models\Status;

use Illuminate\Support\Facades\DB;


use App\Models\ProductCompany;
use App\Models\ProductGroup;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Symfony\Component\HttpFoundation\RequestStack;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        
         
 $productGroupes=ProductGroup::all();
 $productCompanies=ProductCompany::all();
$productCatgories=ProductCategory::all();

 $exporter = User::where('role_id','=',1)->get();
 $importer = User::where('role_id','=',2)->get();
 $representative = User::where('role_id','=',3)->get();


 return view('my_product.machine',compact('id','exporter', 'importer','representative','productGroupes','productCompanies','productCatgories'));
    
 
    }

    public function broken_machine_view($id)
    {


      

 $productGroupes=ProductGroup::all();
 $productCompanies=ProductCompany::all();
$productCatgories=ProductCategory::all();
 $exporter = User::where('role_id','=',1)->get();
 $importer = User::where('role_id','=',2)->get();
 $representative = User::where('role_id','=',3)->get();


 return view('my_product.broken_machine',compact('id','exporter', 'importer','representative','productGroupes','productCompanies','productCatgories'));
    

    }


    public function machine_serch(Request $request)
    {

       if($request->product_location!=null){

        if($request->productGroup!=null && $request->productCompany!=null ){
          $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->where("products.value_location",'=',$request->product_location)->
          leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
          ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("product_details.group_id",$request->productGroup)->where("products.selling_date", null)
          ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
          ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
          }
          else if($request->productGroup!=null){
              $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->where("products.value_location",'=',$request->product_location)->
              leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
              ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("product_details.group_id",$request->productGroup)->where("products.selling_date", null)
              ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
              ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
            
              
          }
         else if( $request->productCompany!=null ){
          $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->where("products.value_location",'=',$request->product_location)->
          leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
          ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("products.selling_date", null)
          ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
          ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
           }
              else{
                 
                  $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->where("products.value_location",'=',$request->product_location)->
                  leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
                  ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("products.selling_date", null)
                  ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
                  ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
                 
  
              }

       }
       else{
        if($request->productGroup!=null && $request->productCompany!=null ){
          $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
          leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
          ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("product_details.group_id",$request->productGroup)->where("products.selling_date", null)
          ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
          ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
          }
          else if($request->productGroup!=null){
              $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
              leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
              ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("product_details.group_id",$request->productGroup)->where("products.selling_date", null)
              ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
              ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
            
              
          }
         else if( $request->productCompany!=null ){
          $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
          leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
          ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("products.selling_date", null)
          ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
          ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
           }
              else{
                 
                  $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
                  leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
                  ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("products.selling_date", null)
                  ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
                  ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
                 
  
              }

       }

 $productGroupes=ProductGroup::where("id",'!=',$request->productGroup)->get();
 $productCompanies=ProductCompany::where("id",'!=',$request->productCompany)->get();
$productCatgories=ProductCategory::where("id",'!=',$request->productCatgory)->get();
$typeproductGroupes=ProductGroup::find($request->productGroup);
$typeproductCompanies=ProductCompany::find($request->productCompany);
$typeproductCatgories=ProductCategory::find($request->productCatgory);
$id=$request->productCatgory;
 $exporter = User::where('role_id','=',1)->get();
 $importer = User::where('role_id','=',2)->get();
 $representative = User::where('role_id','=',3)->get();


 return view('my_product.machine',compact('typeproductCatgories','typeproductCompanies','typeproductGroupes','id','machines','exporter', 'importer','representative','productGroupes','productCompanies','productCatgories'));
 
    

    }
    public function broken_machine_serch(Request $request)
    {

        if($request->productGroup!=null && $request->productCompany!=null ){
        $machines =DB::table('products')->where("products.statuses_id",'=',7)->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("product_details.group_id",$request->productGroup)->where("products.selling_date", null)
        ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
        ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
        }
        else if($request->productGroup!=null){
            $machines =DB::table('products')->where("products.statuses_id",'=',7)->
            leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
            ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("product_details.group_id",$request->productGroup)->where("products.selling_date", null)
            ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
            ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
          
            
        }
       else if( $request->productCompany!=null ){
        $machines =DB::table('products')->where("products.statuses_id",'=',7)->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("products.selling_date", null)
        ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
        ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
         }
            else{
               
                $machines =DB::table('products')->where("products.statuses_id",'=',7)->
                leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
                ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("products.selling_date", null)
                ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
                ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
               

            }
            $productGroupes=ProductGroup::where("id",'!=',$request->productGroup)->get();
            $productCompanies=ProductCompany::where("id",'!=',$request->productCompany)->get();
           $productCatgories=ProductCategory::where("id",'!=',$request->productCatgory)->get();
$typeproductGroupes=ProductGroup::find($request->productGroup);
$typeproductCompanies=ProductCompany::find($request->productCompany);
$typeproductCatgories=ProductCategory::find($request->productCatgory);
$id=$request->productCatgory;
 $exporter = User::where('role_id','=',1)->get();
 $importer = User::where('role_id','=',2)->get();
 $representative = User::where('role_id','=',3)->get();


 return view('my_product.broken_machine',compact('typeproductGroupes','typeproductCompanies','typeproductCatgories','id','machines','exporter', 'importer','representative','productGroupes','productCompanies','productCatgories'));
 
    

    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        
        $productDetail = ProductDetail::all();
        $productCompanies = ProductCompany::all();
        $productCatgories= ProductCategory::all();
        $orders= Order::where('category_id','=',1)->get();
        $status=Status::all();

        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

       

        return view('my_product.add_product',compact('productCompanies','productCatgories','orders','status','exporter', 'importer','representative'));
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
            $myCarancyMull=4.7;
            
            
              }
              else if($request->carency==3){
                $myCarancyMull=4.1;
                
              }

            $order_id = $request->productorder;
     
            //$request->pic->move(public_path('Attachments/' . $order_id ), $fileName);
             for($i=0;$i<$request->qountity;$i++){
                   $newproduct =  Product::create([
                       'product_details_id' => $request->productClass,
                        'primary_price' => ($request->primary_price)*$myCarancyMull,
                       
                   
                       
                       'statuses_id' =>$request->status ,
                       'note' =>$request->note ,
                       
                       'price_with_comm' => ($request->primary_price+$request->Amount_Commission)*$myCarancyMull,
                       'selling_price' => ($request->primary_price+$request->Amount_Commission)*$myCarancyMull,
                       'value_location' => $request->product_location,
          
               
                   ]);
                   $newproduct->order()->attach($order_id);
                   $order = Order::find($order_id);
                    $order->Amount_Commission =  ($order->Amount_Commission)+(($request->Amount_Commission)*$myCarancyMull);
                    $order->Total =  ($order->Total)+(($request->Amount_Commission)*$myCarancyMull)+(($request->primary_price)*$myCarancyMull);

                    $order->save();
           
                 }

            
//                
                  session()->flash('Add', 'تم اضافة المنتج بنجاح ');
             return redirect('OrderDetails/'. $order_id);
                }
           
            
                 
       
            
            
                  
               
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }


    


    public function getproductsDetaile($id,$category_id)
    {
       
        $products = DB::table('product_details')->where("company_id", $id)->where("category_id", $category_id)
->select('product_name')
->distinct()
->pluck("product_name",);
        $products1 = DB::table("product_details")->where("company_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }
    public function getproductsGruops($productName,$category_id)
    {

        
    //     $products = ProductDetail::where('product_name',$name);
        
    //    $productName=$products->product_name;

        $products =DB::table('product_details')
            ->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->where("product_details.product_name", $productName)->where("product_details.category_id", $category_id)->pluck("product_details.id","product_groups.group_name",);
           
           
            return json_encode($products);
          
    }

    public function getorderProductDeteil($id)
    {
        $detailProduct =DB::table('products')->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
       
       
        Join('order_product', 'products.id', '=', 'order_product.products_id')->
        leftJoin('orders', 'order_product.orders_id', '=', 'orders.id') ->
        leftJoin('users', 'orders.exported_id', '=', 'users.id')  ->
        where("product_details.id", $id)
        ->selectRaw('orders.order_due_date,count(order_product.orders_id) as aggregate')
        ->groupBy('orders.order_due_date')->pluck("orders.order_due_date","aggregate");
   
        
  

       
           
            return json_encode($detailProduct);
          
    }
    public function getDetailsOrder($id)
    { 

      $order=Order::find($id); 
      $smallShop = Order::where('category_id','=',3)->where('related_to_id','=',$id)->get();
     
        $detail=OrderDetail::where("orders_id",$id);
        $machines =DB::table('products')->
       leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
       ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id", $id)->where("product_details.category_id", 1)
       ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
       ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
   //return $machines;


   $unAriveMAchine =DB::table('products')->
   leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
   ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id", $id)->where("product_details.category_id", 1)->where("products.statuses_id",'!=', 2)
   ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
   ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
       $grinders =DB::table('products')->
       leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
       ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id", $id)->where("product_details.category_id", 2)
       ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
       ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
       $parts =DB::table('products')->
       leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
       ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id", $id)->where("product_details.category_id", 3)
       ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
       ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
       $invoices = Invoice::where('orders_id',$id)->first();
       
       $details  = InvoicesDetails::where('invoices_id',$invoices->id)->get();
       $exporter = User::where('role_id','=',1)->get();
            $importer = User::where('role_id','=',2)->get();
            $representative = User::where('role_id','=',3)->get();

         return view('order.details_order',compact('unAriveMAchine','order','machines','grinders','invoices','details','parts','exporter', 'importer','representative','id','smallShop'));

    
    }
    




    public function OrderDetails_not_recive_product($id)
    { 

      $order=Order::find($id); 
     

   $unAriveMAchine =DB::table('products')->
   leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
   ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id", $id)->where("product_details.category_id", 1)->where("products.statuses_id",'!=', 2)
   ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
   ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
      
       $exporter = User::where('role_id','=',1)->get();
            $importer = User::where('role_id','=',2)->get();
            $representative = User::where('role_id','=',3)->get();

         return view('order.details_order_not_recive',compact('unAriveMAchine','id','order','exporter', 'importer','representative'));

        
       

       

    }
    public function getExportDetailsOrder($id) 
    {  $boxes =DB::table('products')->
        leftJoin('boxes', 'boxes.id', '=', 'products.box_id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')-> leftJoin('orders', 'orders.id', '=', 'order_product.orders_id') ->where("orders.id", $id)->where("products.box_id",'!=',null)
        ->selectRaw('boxes.id ,boxes.box_code')
        ->groupBy('boxes.id','boxes.box_code')->get();

        $order=Order::find($id);
        
        $detail=OrderDetail::where("orders_id",$id);
        $machines =DB::table('products')->
       leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
       ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id", $id)->where("product_details.category_id", 1)
       ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,count(products.box_id) as box_count,product_details.image_name')
       ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
  // return $machines;
       $grinders =DB::table('products')->
       leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
       ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id", $id)->where("product_details.category_id", 2)
       ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,count(products.box_id) as box_count,product_details.image_name')
       ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
       $parts =DB::table('products')->
       leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
       ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id", $id)->where("product_details.category_id", 3)
       ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,count(products.box_id) as box_count,product_details.image_name')
       ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
       $invoices = Invoice::where('orders_id',$id)->first();
       
       $details  = InvoicesDetails::where('invoices_id',$invoices->id)->get();
      
       $exporter = User::where('role_id','=',1)->get();
            $importer = User::where('role_id','=',2)->get();
            $representative = User::where('role_id','=',3)->get();

        return view('order.export_order.details_order1',compact('order','machines','grinders','parts','details','invoices','exporter', 'importer','representative','id','boxes'));

        
       

       

    }
    public function getproductDetails($id)
    { 
 
        $product =DB::table('products')->where("products.statuses_id",'!=',4)->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.id", $id)->where("products.selling_date", null)
        ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
        ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
        


        $detailProduct =DB::table('products')->where("products.statuses_id",'!=',4)->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
        leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->
        leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')->
       
        Join('order_product', 'products.id', '=', 'order_product.products_id')->
        leftJoin('orders', 'order_product.orders_id', '=', 'orders.id') ->
        leftJoin('users', 'orders.exported_id', '=', 'users.id') ->leftJoin('statuses', 'orders.statuses_id', '=', 'statuses.id') ->
        where("product_details.id", $id)->where("products.selling_date", null)
        ->selectRaw('order_product.orders_id,orders.order_due_date,statuses.id as statusesId,users.name,statuses.status_name,company_name,product_name,group_name,country_of_manufacture,count(order_product.orders_id) as aggregate,product_details.image_name')
        ->groupBy('statuses.id','users.name','orders.order_due_date','order_product.orders_id','statuses.status_name','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
   

        
// $product = Product::where('category_id', $id)->get();
 
$exporter = User::where('role_id','=',1)->get();
$importer = User::where('role_id','=',2)->get();
$representative = User::where('role_id','=',3)->get();


 return view('order.order_product_details',compact('detailProduct','product','exporter', 'importer','representative'));



 
    

    }


    public function getexport_productDetails($id)
    { 
 
        $product =DB::table('products')->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.id", $id)->where("products.selling_date", null)
        ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
        ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
        


        $detailProduct =DB::table('products')->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
        leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->
        leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')->
       
        Join('order_product', 'products.id', '=', 'order_product.products_id')->
        leftJoin('orders', 'order_product.orders_id', '=', 'orders.id') ->
        leftJoin('users', 'orders.exported_id', '=', 'users.id') ->leftJoin('statuses', 'orders.statuses_id', '=', 'statuses.id') ->
        where("product_details.id", $id)->where("products.selling_date", null)
        ->selectRaw('order_product.orders_id,orders.order_due_date,statuses.id as statusesId,users.name,statuses.status_name,company_name,product_name,group_name,country_of_manufacture,count(order_product.orders_id) as aggregate,product_details.image_name')
        ->groupBy('statuses.id','users.name','orders.order_due_date','order_product.orders_id','statuses.status_name','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
   

        
// $product = Product::where('category_id', $id)->get();
 


 return view('order.export_order.export_product_details',compact('detailProduct','product'));



 
    

    }


    public function getexport_productBoxcDetails(Request $request)
    { 

      

        $boxes =DB::table('products')->
        leftJoin('boxes', 'boxes.id', '=', 'products.box_id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')-> leftJoin('orders', 'orders.id', '=', 'order_product.orders_id') ->where("orders.id", $request->order_id)->where("products.box_id",'!=',null)
        ->selectRaw('boxes.id ,boxes.box_code')
        ->groupBy('boxes.id','boxes.box_code')->get();
        
     
        $product =DB::table('products')->
       leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
       ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id", $request->order_id)->where("products.product_details_id", $request->product_id)
       ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,count(products.box_id) as box_count,product_details.image_name')
       ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
        
      


        $detailProduct =DB::table('products')->where("products.product_details_id", $request->product_id)->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
        leftJoin('boxes', 'boxes.id', '=', 'products.box_id')->
        leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->
        leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') 
        ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id", $request->order_id)
        -> get();
        
       


//         $detailProduct =DB::table('products')->
//         leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
//         leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->
//         leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')->
       
//         Join('order_product', 'products.id', '=', 'order_product.products_id')->
//         leftJoin('orders', 'order_product.orders_id', '=', 'orders.id') ->
//         leftJoin('users', 'orders.exported_id', '=', 'users.id') ->leftJoin('statuses', 'orders.statuses_id', '=', 'statuses.id') ->
//         where("product_details.id", $id)->where("products.selling_date", null)
//         ->selectRaw('order_product.orders_id,orders.order_due_date,statuses.id as statusesId,users.name,statuses.status_name,company_name,product_name,group_name,country_of_manufacture,count(order_product.orders_id) as aggregate,product_details.image_name')
//         ->groupBy('statuses.id','users.name','orders.order_due_date','order_product.orders_id','statuses.status_name','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
   

        
// // $product = Product::where('category_id', $id)->get();
 


 return view('order.export_order.export_product_box_details',compact('detailProduct','product','boxes'));


 
 
    

    }
 

    public function rechoce_product_confirm(Request $request)
    { $unwont_prodect=Product::find($request->product_id);
        $sellingDate=$unwont_prodect->selling_date;
        $price=$unwont_prodect->selling_price;
        $commision=$unwont_prodect->selling_price_with_comm;
        $unwont_prodect->update([
            'selling_date' => null,
            'selling_price' => $unwont_prodect->price_with_comm,
            'selling_price_with_comm' => null,
 
    
    
            ]);
            $unwont_prodect->order()->detach($request->order_id);
        $allProducts =Product::where("product_details_id", $request->id)->where("selling_date", null)->where("statuses_id", 2)->get();
         
        $Olderproduct=Product::where("product_details_id", $request->id)->where("selling_date", null) ->where("statuses_id", 2)->first();
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
           'selling_date' => $sellingDate,
           'selling_price' => $price,
           'selling_price_with_comm' => $commision,

   
   
           ]);
        $Olderproduct->order()->attach($request->order_id);


        session()->flash('Add', ' تم استبدال المنتج');
        return redirect('ExportOrderDetails/'. $request->order_id);

       

        
    }
    public function getrechose_product(Request $request)
    { 
        

        $machines =DB::table('products')->where("statuses_id", 2)->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id", $request->category_id)->where("products.selling_date", null)
        ->selectRaw('product_details.id as product_detail_id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
        ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
        
       $product_id=$request->product_id;

$order_id=$request->order_id;
        return view('order.export_order.export_product_rechose',compact('machines','product_id','order_id'));

        
    }

    public function submit_product(Request $request){
       
        $product = Product::findOrFail($request->id);

      

            $product->update([
                'statuses_id' => 2,
            ]);
            if($request->supmit_from==2){
                session()->flash('Add', '     :تم تأكيد المنتج بنجاح يرجى اعطاءه الكود التالي:'.' OR'.$request->order_id.'NO'.$request->id );

                          return redirect('export_order_prodect_code/'. $request->order_id);
              }

            session()->flash('Add', '     :تم تأكيد المنتج بنجاح يرجى اعطاءه الكود التالي:'.' OR'.$request->order_id.'NO'.$request->id );
            return redirect('OrderDetails_not_recive_product/'. $request->order_id);


    }

    
    public function submit_all_product(Request $request){
       
        $product =DB::table('products')->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')
        ->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')
        ->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') 
        ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",  $request->order_id)->where("products.product_details_id", $request->id)
        ->selectRaw('products.id')
        ->get();
        foreach($product as $i){
            $myProduct=Product::findOrFail($i->id);
            $myProduct->update([
                'statuses_id' => 2,
            ]);

            
        }
       
        session()->flash('Add', '     :تم تأكيد المنتجات بنجاح    :'.'PNO'.$request->id .' ORNO '.$request->order_id);
            return redirect('OrderDetails/'. $request->order_id);


    }


    public function unsubmit_product(Request $request){
       
        $product = Product::findOrFail($request->id);

      

            $product->update([
                'statuses_id' => 4,
            ]);

                
if($request->unsubmit_from==2){
    session()->flash('Add', ' تم تحديد المنتج كانقص في الطلبية');
                   return redirect('order_prodect_code/'. $request->order_id);
       }

            session()->flash('Add', 'تم تحديد المنتج كنقص');
            return redirect('OrderDetails/'. $request->order_id);


    }

    public function delete_product(Request $request){
     
        $product = Product::findOrFail($request->id);

      

            $product->update([
                'statuses_id' => 4,
            ]);
            $order=Order::find($request->order_id);
            $invoice=Invoice::where('orders_id',$request->order_id)->first();
            if($invoice !=null){
            $myInvoice=Invoice::findOrFail($invoice->id);
            
            $newValueForInvoice=$invoice->Amount_collection - $product->primary_price;
            $newTotalForInvoice=$invoice->Total - $product->primary_price;
            $newTotalForOrder=$order->Total - $product->primary_price;
            $newAmountComtion=$order->Amount_Commission - ($product->price_with_comm-$product->primary_price);
            }
            $myInvoice ->update([
                'Amount_collection' =>$newValueForInvoice ,
                'Total' =>$newTotalForInvoice ,
            ]);
            $order ->update([
                'Total' => $newTotalForOrder,
                'Amount_Commission' =>$newAmountComtion ,
            ]);
                
            $product->order()->detach($request->order_id);
if($request->unsubmit_from==2){
    session()->flash('Add', ' تم تحديد المنتج كانقص في الطلبية');
                   return redirect('order_prodect_code/'. $request->order_id);
       }

            session()->flash('Add', 'تم تحديد المنتج كنقص');
            return redirect('OrderDetails/'. $request->order_id);


    }
    public function getimport_order_productDetails(Request $request)
    { 
        $surproduct =DB::table('products')->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')
        ->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')
        ->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') 
        ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",  $request->order_id)->where("products.product_details_id", $request->product_id)->where("products.statuses_id", 2)
        ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
        ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
         
       
        
 
      

    
        
     
        $product =DB::table('products')->
       leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')
       ->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')
       ->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
       ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') 
       ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",  $request->order_id)->where("products.product_details_id", $request->product_id)
       ->selectRaw('order_product.orders_id,product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
       ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name','order_product.orders_id')->get();
        
      

        $detailProduct =DB::table('products')->where("products.product_details_id", $request->product_id)->
        leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
       
        leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->
        leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') 
        ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id", $request->order_id)
        ->get();
        
    


 return view('order.import_product_details',compact('detailProduct','product','surproduct'));



 
    

    }


    public function removeProductFomOrder(Request $request)
    {
      
        $product=Product::find($request->id);
      
$order=Order::find($request->order_id);
$invoice=Invoice::where('orders_id',$request->order_id)->first();
if($invoice !=null){
$myInvoice=Invoice::findOrFail($invoice->id);

$newValueForInvoice=$invoice->Amount_collection - $request->product_price;
$newTotalForInvoice=$invoice->Total - $request->product_price;
$newTotalForOrder=$order->Total - $request->product_price;
$newAmountComtion=$order->Amount_Commission - ($product->selling_price_with_comm-$product->selling_price);
}
$product->order()->detach($request->order_id);
$product ->update([
    'selling_date' => null,
    
]);
$myInvoice ->update([
    'Amount_collection' =>$newValueForInvoice ,
    'Total' =>$newTotalForInvoice ,
]);
$order ->update([
    'Total' => $newTotalForOrder,
    'Amount_Commission' =>$newAmountComtion ,
]);
if($request->place_delete==2){
  session()->flash('Add', ' تم ازالة المنتج من الطلبية');
            return redirect('export_order_prodect_code/'. $request->order_id);
}
session()->flash('Add', ' تم ازالة المنتج من الطلبية');
            return redirect('ExportOrderDetails/'. $request->order_id);

    }


    public function edit_price_product(Request $request)
    { 
        $product=Product::find($request->id);
    
$order=Order::find($request->order_id);
$invoice=Invoice::where('orders_id',$request->order_id)->first();
if($invoice !=null){

$myInvoice=Invoice::findOrFail($invoice->id);

$newValueForInvoice=$invoice->Amount_collection -$request->old_price+ $request->price;
$newTotalForInvoice=$invoice->Total -$request->old_price+ $request->price;
$newTotalForOrder=$order->Total -$request->old_price+ $request->price;
$newAmountComtion=$order->Amount_Commission - $request->old_comation+$request->comation;
}
$order ->update([
    'Total' => $newTotalForOrder,
   'Amount_Commission'=>$newAmountComtion
]);

$product->update([
    'selling_price_with_comm' => $request->price,
    'selling_price'=> $request->price-$request->comation,

    
]);
$myInvoice ->update([
    'Amount_collection' =>$newValueForInvoice ,
    'Total' =>$newTotalForInvoice ,
]);

  session()->flash('Add', 'تم تعديل سعر المنتج مع تعديل الفاتورة واجمال الطلبية');
            return redirect('export_order_prodect_code/'. $request->order_id);


    }

    public function edit_price_product_import(Request $request)
    { 
        $product=Product::find($request->id);
    
$order=Order::find($request->order_id);


                    $order->Total =  ($order->Total)-$request->old_price-$request->old_comation+$request->price+$request->comation;
                    $order->Amount_Commission =  ($order->Amount_Commission)-$request->old_comation+$request->comation;

                    $order->save();
$invoice=Invoice::where('orders_id',$request->order_id)->first();
if($invoice !=null){

$myInvoice=Invoice::findOrFail($invoice->id);

$newValueForInvoice=$order->Total;
$newTotalForInvoice=$order->Total;
//$newTotalForOrder=$order->Total -$request->old_price+ $request->price;
//$newAmountComtion=$order->Amount_Commission - ($product->selling_price_with_comm-$product->selling_price);
}

$product->update([
    'primary_price' => $request->price,
    'price_with_comm' => $request->price+$request->comation,
]);
$myInvoice ->update([
    'Amount_collection' =>$newValueForInvoice ,
    'Total' =>$newTotalForInvoice ,
]);


  session()->flash('Add', 'تم تعديل سعر المنتج مع تعديل الفاتورة واجمال الطلبية');
            return redirect('order_prodect_code/'. $request->order_id);


    }


    public function product_report_view(){
       
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();
        
        $Statuses=Status::where("id",'!=',4)->get();
        return view('reports.product_report',compact('exporter', 'importer','representative','Statuses'));
           
    }
    public function product_report_serch(Request $request){
        $products =DB::table('products')->
       leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')
       ->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')
       ->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
       ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') 
       ->Join('order_product', 'products.id', '=', 'order_product.products_id')-> leftJoin('orders', 'order_product.orders_id', '=', 'orders.id') -> leftJoin('users', 'orders.exported_id', '=', 'users.id') ->where("products.id", $request->product_id)
      -> leftJoin('boxes', 'boxes.id', '=', 'products.box_id')->leftJoin('shipments', 'boxes.shipment_id', '=', 'shipments.id') -> get();
      
     $product_data =Product::find($request->product_id);
     
     if ($products->isEmpty()==false) {
   
        $satatus=Status::find($product_data->statuses_id);
      
        
       }
       else{

        $satatus=new Request(['id'=>0,
        'status_name'=>null,
      
        
        ]);
       }
       $Statuses=Status::where("id",'!=',4)->get();
  
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

        return view('reports.product_report',compact('exporter', 'importer','representative','products','satatus','Statuses'));
           
      
        
           
    }



    public function product_set_proken(Request $request){
       
          $product =Product::find($request->products_id);
       
          $product->update(['statuses_id' => 7,
        
        'note'=>$request->note]);
        if($request->sybmit_from==2){
            session()->flash('Add', ' تم تحديد المنتج كانقص في القطع الداخلية');
            return redirect('prodect_code/');
          }
          session()->flash('Add', ' تم تحديد المنتج كانقص في القطع الداخلية');
            return redirect('product_report/');


    }

    public function product_remove_from_proken(Request $request){
      
        $product =Product::find($request->products_id);
     
        $product->update(['statuses_id' => 2,
      
      'note'=>$request->note]);

      if($request->sybmit_from==2){
        session()->flash('Add', ' تم استعادة المنتج');
        return redirect('prodect_code/');
      }
        session()->flash('Add', ' تم استعادة المنتج');
          return redirect('product_report/');


  }


  public function machine_serch_to_export_order(Request $request)
  { 
   
     if($request->importOrder!=null){


        if($request->productGroup!=null && $request->productCompany!=null  ){
            if($request->productstatus==null){
          $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
          leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
          ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",$request->importOrder)->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("products.value_location",$request->productGroup)->where("products.selling_date", null)
          ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
          ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();}
          else{
    
            $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'=',$request->productstatus)->
            leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
            ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",$request->importOrder)->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("products.value_location",$request->productGroup)->where("products.selling_date", null)
            ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
            ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
    
          }
          }
          else if($request->productGroup!=null){
            if($request->productstatus==null){
              $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
              leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
              ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",$request->importOrder)->where("product_details.category_id",$request->productCatgory)->where("products.value_location",$request->productGroup)->where("products.selling_date", null)
              ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
              ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();}
              else{
    
                $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'=',$request->productstatus)->
                leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
                ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",$request->importOrder)->where("order_product.orders_id",$request->importOrder)->where("product_details.category_id",$request->productCatgory)->where("products.value_location",$request->productGroup)->where("products.selling_date", null)
                ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
                ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
              }
            
              
          }
         else if( $request->productCompany!=null ){
            if($request->productstatus==null){
          $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
          leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
          ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",$request->importOrder)->where("order_product.orders_id",$request->importOrder)->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("products.selling_date", null)
          ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
          ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();}
          else{
            $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'=',$request->productstatus)->
            leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
            ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",$request->importOrder)->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("products.selling_date", null)
            ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
            ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
    
            
          }
           }
              else{
                if($request->productstatus==null){
                 
                  $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
                  leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
                  ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",$request->importOrder)->where("product_details.category_id",$request->productCatgory)->where("products.selling_date", null)
                  ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
                  ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();}
                  else{
    
                    $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'=',$request->productstatus)->
                    leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
                    ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",$request->importOrder)->where("product_details.category_id",$request->productCatgory)->where("products.selling_date", null)
                    ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
                    ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
                    
                  }
                 
    
              }

     }
     else{


        if($request->productGroup!=null && $request->productCompany!=null  ){
            if($request->productstatus==null){
          $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
          leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
          ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("products.value_location",$request->productGroup)->where("products.selling_date", null)
          ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
          ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();}
          else{
    
            $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'=',$request->productstatus)->
            leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
            ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("products.value_location",$request->productGroup)->where("products.selling_date", null)
            ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
            ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
    
          }
          }
          else if($request->productGroup!=null){
            if($request->productstatus==null){
              $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
              leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
              ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("products.value_location",$request->productGroup)->where("products.selling_date", null)
              ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
              ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();}
              else{
    
                $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'=',$request->productstatus)->
                leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
                ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("products.value_location",$request->productGroup)->where("products.selling_date", null)
                ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
                ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
              }
            
              
          }
         else if( $request->productCompany!=null ){
            if($request->productstatus==null){
          $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
          leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
          ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("products.selling_date", null)
          ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
          ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();}
          else{
            $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'=',$request->productstatus)->
            leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
            ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("products.selling_date", null)
            ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
            ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
    
            
          }
           }
              else{
                if($request->productstatus==null){
                 
                  $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
                  leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
                  ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("products.selling_date", null)
                  ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
                  ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();}
                  else{
    
                    $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'=',$request->productstatus)->
                    leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
                    ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("products.selling_date", null)
                    ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
                    ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
                    
                  }
                 
    
              }
     }


          

$productGroupes=ProductGroup::where("id",'!=',$request->productGroup)->get();
$productCompanies=ProductCompany::where("id",'!=',$request->productCompany)->get();
$productCatgories=ProductCategory::where("id",'!=',$request->productCatgory)->get();
$importOrder =Order::where("category_id",'=',1)->get();


$status=Status::where("id",'!=',$request->productstatus)->where("id",'>',6)->get();
$typeproductGroupes=ProductGroup::find($request->productGroup);
$typeproductCompanies=ProductCompany::find($request->productCompany);
$typeproductCatgories=ProductCategory::find($request->productCatgory);
$typeproductStatus=Status::find($request->productstatus);
$typeOrder=Order::find($request->importOrder);

$id=$request->productCatgory;
$exporter = User::where('role_id','=',1)->get();
$importer = User::where('role_id','=',2)->get();
$representative = User::where('role_id','=',3)->get();

$order_id=$request->order_id;
return view('order.export_order.add_product_to_order',compact('order_id','typeOrder','importOrder','typeproductStatus','status','typeproductCatgories','typeproductCompanies','typeproductGroupes','id','machines','exporter', 'importer','representative','productGroupes','productCompanies','productCatgories'));

  

  }





  //


 public function machine_serch_to_export_order_bycode(Request $request)
  { 
   
     if($request->importOrder!=null){


        if($request->productGroup!=null && $request->productCompany!=null  ){
            if($request->productstatus==null){
          $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
          leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
          ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",$request->importOrder)->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("products.value_location",$request->productGroup)->where("products.selling_date", null)
          ->get();}
          else{
    
            $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'=',$request->productstatus)->
            leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
            ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",$request->importOrder)->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("products.value_location",$request->productGroup)->where("products.selling_date", null)
            ->get();
    
          }
          }
          else if($request->productGroup!=null){
            if($request->productstatus==null){
              $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
              leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
              ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",$request->importOrder)->where("product_details.category_id",$request->productCatgory)->where("products.value_location",$request->productGroup)->where("products.selling_date", null)
              ->get();}
              else{
    
                $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'=',$request->productstatus)->
                leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
                ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",$request->importOrder)->where("order_product.orders_id",$request->importOrder)->where("product_details.category_id",$request->productCatgory)->where("products.value_location",$request->productGroup)->where("products.selling_date", null)
                ->get();
              }
            
              
          }
         else if( $request->productCompany!=null ){
            if($request->productstatus==null){
          $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
          leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
          ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",$request->importOrder)->where("order_product.orders_id",$request->importOrder)->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("products.selling_date", null)
          ->get();}
          else{
            $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'=',$request->productstatus)->
            leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
            ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",$request->importOrder)->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("products.selling_date", null)
           ->get();
    
            
          }
           }
              else{
                if($request->productstatus==null){
                 
                  $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
                  leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
                  ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",$request->importOrder)->where("product_details.category_id",$request->productCatgory)->where("products.selling_date", null)
                 ->get();}
                  else{
    
                    $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'=',$request->productstatus)->
                    leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
                    ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("order_product.orders_id",$request->importOrder)->where("product_details.category_id",$request->productCatgory)->where("products.selling_date", null)
                ->get();
                    
                  }
                 
    
              }

     }
     else{


        if($request->productGroup!=null && $request->productCompany!=null  ){
            if($request->productstatus==null){
          $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
          leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
          ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("products.value_location",$request->productGroup)->where("products.selling_date", null)
          ->get();}
          else{
    
            $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'=',$request->productstatus)->
            leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
            ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("products.value_location",$request->productGroup)->where("products.selling_date", null)
           ->get();
    
          }
          }
          else if($request->productGroup!=null){
            if($request->productstatus==null){
              $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
              leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
              ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("products.value_location",$request->productGroup)->where("products.selling_date", null)
              ->get();}
              else{
    
                $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'=',$request->productstatus)->
                leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
                ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("products.value_location",$request->productGroup)->where("products.selling_date", null)
                ->get();
              }
            
              
          }
         else if( $request->productCompany!=null ){
            if($request->productstatus==null){
          $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
          leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
          ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("products.selling_date", null)
          ->get();}
          else{
            $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'=',$request->productstatus)->
            leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
            ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("product_details.company_id",$request->productCompany)->where("products.selling_date", null)
           ->get();
    
            
          }
           }
              else{
                if($request->productstatus==null){
                 
                  $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'!=',7)->
                  leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
                  ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("products.selling_date", null)
                  ->get();}
                  else{
    
                    $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.statuses_id",'=',$request->productstatus)->
                    leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
                    ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("products.selling_date", null)
                    ->get();
                    
                  }
                 
    
              }
     }


          

$productGroupes=ProductGroup::where("id",'!=',$request->productGroup)->get();
$productCompanies=ProductCompany::where("id",'!=',$request->productCompany)->get();
$productCatgories=ProductCategory::where("id",'!=',$request->productCatgory)->get();
$importOrder =Order::where("category_id",'=',1)->get();


$status=Status::where("id",'!=',$request->productstatus)->where("id",'>',6)->get();
$typeproductGroupes=ProductGroup::find($request->productGroup);
$typeproductCompanies=ProductCompany::find($request->productCompany);
$typeproductCatgories=ProductCategory::find($request->productCatgory);
$typeproductStatus=Status::find($request->productstatus);
$typeOrder=Order::find($request->importOrder);

$id=$request->productCatgory;
$exporter = User::where('role_id','=',1)->get();
$importer = User::where('role_id','=',2)->get();
$representative = User::where('role_id','=',3)->get();

$order_id=$request->order_id;
return view('order.export_order.add_product_to_order_bycode',compact('order_id','typeOrder','importOrder','typeproductStatus','status','typeproductCatgories','typeproductCompanies','typeproductGroupes','id','machines','exporter', 'importer','representative','productGroupes','productCompanies','productCatgories'));

  

  }


  //

  public function update_location_product(Request $request){
      
    $product = Product::findOrFail($request->product_id);

  

        $product->update([
            'value_location' => $request->location_id,
        ]);
        if($request->sybmit_from==2){
            session()->flash('Add','تم نقل المنتج بجاح');
            return redirect('prodect_code/');
          }

        session()->flash('Add','تم نقل المنتج بجاح');
        return redirect('product_report');


}

public function update_status_product(Request $request)
{ 
    $product =Product::find($request->product_id);
       
    $product->update(['statuses_id' => $request->status_id,
  
  'note'=>$request->note]);

  if($request->sybmit_from==2){
    session()->flash('Add', 'تم تحديث الحالة');
    return redirect('prodect_code/');
  }
    session()->flash('Add', 'تم تحديث الحالة');
      return redirect('product_report/');


}
///////
public function prodect_code()
    {
       
        $productCategories = ProductCategory::all();
        $statuses = Status::where('id','!=',5)->where('id','!=',6)->get();
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();


        return view('my_product.product_code',compact('statuses',"productCategories",'exporter', 'importer','representative',));
  
    
    }

    public function prodect_code_serch(Request $request)
    {
    
        $typelocationId=null;
        $typelocationName=null;
       
    
        $statuses = Status::where('id','!=',5)->where('id','!=',6)->get();

        if($request->location==null&& $request->status==null){

            // $machines =DB::table('products')->where("products.statuses_id",'!=',4)->
            // leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
            // ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)->where("products.selling_date", null)
            // ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
            // ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
           


            $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.selling_date", null)->
            leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
            leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->
            leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
            ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id')
            ->leftJoin('boxes', 'products.box_id', '=','boxes.id') ->
          
            Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)
            ->get();
          
            
        }
      else if($request->location!=null&& $request->status==null){
        
            $machines =DB::table('products')->where("products.statuses_id",'!=',4)->where("products.selling_date", null)->where("products.value_location",'=',$request->location)->
            leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
            leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->
            leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
            ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id')
            ->leftJoin('boxes', 'products.box_id', '=','boxes.id') ->
          
            Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)
            ->get();
           
         //   $typelocationId=$request->location;
        
       
        
    }
    else if($request->location==null&& $request->status!=null){
      
        if( $request->status!=-1){
            $machines =DB::table('products')->where("products.selling_date", null)->
            leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
            leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->
            leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
            ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id')
            ->leftJoin('boxes', 'products.box_id', '=','boxes.id') ->where("statuses.id", '=',$request->status)->
          
            Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)
            ->get();}
            else{
                
                $machines =DB::table('products')->where("products.selling_date", null)->
                leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
                leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->
                leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
                ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id')
                ->leftJoin('boxes', 'products.box_id', '=','boxes.id') ->where("statuses.id",'!=',4)->where("statuses.id",'!=',7)->where("statuses.id",'!=',8)->
              
                Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)
                ->get();
            }
           
            
        }  
        else if($request->location!=null&& $request->status!=null){
            if( $request->status!=-1){
            $machines =DB::table('products')->where("products.selling_date", null)->where("products.value_location",'=',$request->location)->
            leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
            leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->
            leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
            ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id')
            ->leftJoin('boxes', 'products.box_id', '=','boxes.id') ->where("statuses.id", '=',$request->status)->
          
            Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)
            ->get();}
            else{
                $machines =DB::table('products')->where("products.selling_date", null)->where("products.value_location",'=',$request->location)->
                leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
                leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->
                leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
                ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id')
                ->leftJoin('boxes', 'products.box_id', '=','boxes.id') ->where("statuses.id", '!=',4)->where("statuses.id", '!=',7)->where("statuses.id", '!=',8)->
              
                Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id",$request->productCatgory)
                ->get();
            }
         //   $typelocationId=$request->location;
                
         
        
           
            
        }
    
        




               $productCategories=ProductCategory::where("id",'!=',$request->productCatgory)->get();
             
               $typeproductCatgories=ProductCategory::find($request->productCatgory);
               $typeStatus=Status::find($request->status);
               $id=$request->productCatgory;
                $exporter = User::where('role_id','=',1)->get();
                $importer = User::where('role_id','=',2)->get();
                $representative = User::where('role_id','=',3)->get();
               
               $order=Order::find($request->order_id);
              
                return view('my_product.product_code',compact('typelocationId','typelocationName','statuses','typeStatus','typeproductCatgories','order','machines','exporter', 'importer','representative','productCategories'));
               

    }
}



