<?php

namespace App\Http\Controllers;

use App\Models\Box;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Ui\Presets\React;

class ShipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $importClints = User::where('role_id','=',1)->get();
        $shipments = Shipment::all();
      
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

       

       
       

        return view('shipment.shipmentes',compact('shipments','exporter', 'importer','representative','importClints'));

  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    
        $boxes =DB::table('products')->
        leftJoin('boxes', 'boxes.id', '=', 'products.box_id')->where("boxes.shipment_id",'=',null) ->Join('order_product', 'products.id', '=', 'order_product.products_id')-> leftJoin('orders', 'orders.id', '=', 'order_product.orders_id') ->where("orders.exported_id", $request->clintId)->where("products.box_id",'!=',null)
        ->selectRaw('boxes.id as boxId,count(products.box_id) as count_insaid,boxes.box_code')
        ->groupBy('boxes.id','boxes.box_code')->get();
      
        
        $importClints = User::where('id','=',$request->clintId)->get();
         // $clients = User::where('role_id','=',3)->get();
         $exporter = User::where('role_id','=',1)->get();
         $importer = User::where('role_id','=',2)->get();
         $representative = User::where('role_id','=',3)->get();
         return view('shipment.add_shipment',compact('importClints','exporter', 'importer','representative','boxes'));
 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    

     
     $boxes=json_decode($request->my_hidden_input);
       
         

     if($boxes == null){
         session()->flash('Erorr', 'يرجى اختيار صنايق هذه الشحنة');
         //  return $request;
           return redirect('shipmentes');
     }
    
     if($request->pic!=null){
         

   
    
         $imageName = $request->pic;
         $fileName = $imageName->getClientOriginalName();
     
         Shipment::create([
          'marina_address' => $request->marce,
          'parking_number' => $request->parking_number,
          
          'image_name' => $fileName,
          'mark' => $request->Mark,
          'Name_driver_lansh' => $request->naghda_name,

          'number_driver_lansh' =>$request->naghda_number ,

          'Name_driver' => $request->driving_name,
          'number_driver' => $request->driving_number,
         

          'shiping_date' => $request->sipment_date,
          'client_id' => $request->clints,
          
          'carton_number' => count($boxes),
  
      ]);
  // move pic
  $shipment_id = Shipment::latest()->first()->id;
  
  $request->pic->move(public_path('Attachments/shipment/' . $shipment_id ), $fileName);
  foreach($boxes as $box)
  
     { 
        $my_box = Box::findOrFail($box->id);
 
        $my_box->update([
        'shipment_id' =>$shipment_id,
        


        ]);
 
       }
 
  
       

  
      session()->flash('Add', 'تم اضافةالشحنة بنجاح ');
      return redirect('shipmentes');
        
     
  }
else{

    
   

    Shipment::create([
     'marina_address' => $request->marce,
     'parking_number' => $request->parking_number,
     
     
     'mark' => $request->Mark,
     'Name_driver_lansh' => $request->naghda_name,

     'number_driver_lansh' =>$request->naghda_number ,

     'Name_driver' => $request->driving_name,
     'number_driver' => $request->driving_number,
    

     'shiping_date' => $request->sipment_date,
     'client_id' => $request->clints,
     
     'carton_number' => count($boxes),

 ]);
// move pic
$shipment_id = Shipment::latest()->first()->id;


foreach($boxes as $box)

{ 
   $my_box = Box::findOrFail($box->id);

   $my_box->update([
   'shipment_id' =>$shipment_id,
   


   ]);

  }


  


 session()->flash('Add', 'تم اضافةالشحنة بنجاح ');
 return redirect('shipmentes');
    
}
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $re)
    {
        return $request;
    }

    public function shipment_serch(Request $request)
    {

        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
       

        if($start_at==null){

           
            $shipments = Shipment::where('client_id','=',$request->importClint)->where('shiping_date','<=',[$end_at])->get();

        }
        else
        {

        $shipments = Shipment::where('client_id','=',$request->importClint)->whereBetween('shiping_date',[$start_at,$end_at])->get();

        }
        $importClints = User::where('role_id','=',1)->get();
      
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();
        $typeimportClint=User::find($request->importClint);

       

       
       

        return view('shipment.shipmentes',compact('shipments','start_at','end_at','typeimportClint','exporter', 'importer','representative','importClints'));

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipment $shipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipment $shipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       
        $shipment = Shipment::findOrFail($request->shipment_id);
        $shipment->image_name="";
        $shipment->update();
        Storage::disk('public_uploads')->delete('shipment/'.$request->shipment_id.'/'.$request->image_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }
    public function getboxesOrder($clientId)
    {

        
    //     $products = ProductDetail::where('product_name',$name);
        
    //    $productName=$products->product_name;
    $machines =DB::table('products')->
    leftJoin('boxes', 'boxes.id', '=', 'products.box_id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')-> leftJoin('orders', 'orders.id', '=', 'order_product.orders_id') ->where("orders.exported_id", 6)->where("products.box_id",'!=',null)
    ->selectRaw('boxes.id as boxId,count(products.box_id) as count_insaid,boxes.box_code')
    ->groupBy('boxes.id','boxes.box_code')->get();
  
        
       return json_encode($machines);
          
    }


    public function create1(Request $request)
    {
       return $request;
         
       $importClints = User::where('role_id','=',1)->get();
        // $clients = User::where('role_id','=',3)->get();
        $exporter = User::where('role_id','=',1)->get();
        $importer = User::where('role_id','=',2)->get();
        $representative = User::where('role_id','=',3)->get();

       

       
      

        // $machines =DB::table('products')->
        // leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        // ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id')
        //  ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id", 1)->where("products.selling_date", null)
        // ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
        // ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
       
       
        // $grinder =DB::table('products')->
        // leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        // ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id", 2)->where("products.selling_date", null)
        // ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
        // ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();
        // $parts =DB::table('products')->
        // leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        // ->leftJoin('statuses', 'products.statuses_id', '=', 'statuses.id') ->Join('order_product', 'products.id', '=', 'order_product.products_id')->where("product_details.category_id", 3)->where("products.selling_date", null)
        // ->selectRaw('product_details.id,company_name,product_name,group_name,country_of_manufacture,count(products.product_details_id) as aggregate,product_details.image_name')
        // ->groupBy('product_details.id','company_name','product_name','country_of_manufacture','group_name','product_details.image_name')->get();


       

       
    }
    public function getShipmentDeteil($id)
    {

        $shipment=Shipment::find($id);
        
        $boxes =DB::table('products')->
        leftJoin('boxes', 'boxes.id', '=', 'products.box_id')->where("boxes.shipment_id",'=',$id) 
        ->selectRaw('boxes.id as boxId,count(products.box_id) as count_insaid,boxes.box_code')
        ->groupBy('boxes.id','boxes.box_code')->get();
      
       $exporter = User::where('role_id','=',1)->get();
            $importer = User::where('role_id','=',2)->get();
            $representative = User::where('role_id','=',3)->get();

        return view('shipment.details_shipment',compact('exporter', 'importer','representative','shipment','boxes'));

        
       

       

    }
    public function addAttachments(Request $request)
    {
        $imageName = $request->file_name;
        $fileName = $imageName->getClientOriginalName();
        
        $shipment = Shipment::findOrFail($request->shipment_id);
        $shipment->image_name=$fileName;
        $shipment->update();
        $request->file_name->move(public_path('Attachments/shipment/' . $request->shipment_id ), $fileName);
        
        session()->flash('delete', 'تمت اضافة المرفق بنجاح');
        return back();
    }


    public function get_file($shipment_id,$file_name)

    {
        $contents= Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix('shipment/'.$shipment_id.'/'.$file_name);
        return response()->download( $contents);
    }



    public function open_file($shipment_id,$file_name)

    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix('shipment/'.$shipment_id.'/'.$file_name);
        return response()->file($files);
    }
}
