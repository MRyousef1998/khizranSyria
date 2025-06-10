<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipment;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

class ShipmentController extends Controller
{
    public function get_user_shipmentes(Request $request)
    
    {
       
        $shipments = Shipment::where('client_id','=',$request->id)->orderBy('shiping_date','DESC')->get();
          
          
          $my_final_array=[];
          foreach($shipments as $shipment){
            $my_final_array[]= $shipment;
    
          }
    
         
         
          $myShipment = $this->paginate($my_final_array);
          return $myShipment;
           

            
            }


            public function getShipmentDeteil(Request $request)
    {

       // $shipment=Shipment::find( $request->id);
        
        // $boxes =DB::table('products')->
        // leftJoin('boxes', 'boxes.id', '=', 'products.box_id')->where("boxes.shipment_id",'=',$request->id) 
        // ->selectRaw('boxes.id as boxId,count(products.box_id) as count_insaid,boxes.box_code')
        // ->groupBy('boxes.id','boxes.box_code')->get();

        // $detailBox =DB::table('products')->where("products.box_id", $request->box_id)->
        //  leftJoin('boxes', 'boxes.id', '=', 'products.box_id')->
        // leftJoin('product_details', 'product_details.id', '=', 'products.product_details_id')->
        // leftJoin('product_groups', 'product_details.group_id', '=', 'product_groups.id')->
        // leftJoin('product_companies', 'product_details.company_id', '=', 'product_companies.id')
        //  ->get();
  
      //   $detailBoxes =DB::table('products')->
      //   leftJoin('boxes', 'boxes.id', '=', 'products.box_id')->where("boxes.shipment_id",'=',$request->id)->
     
      //  get();
      $detailBoxes =DB::table('boxes')->
      leftJoin('products', 'products.box_id', '=', 'boxes.id')->where("boxes.shipment_id",'=',$request->id)-> get();
    

    $my_final_array=[];
    foreach($detailBoxes as $detailBox){
      $my_final_array[]= $detailBox;

    }

   
   
    $myBox = $this->paginate($my_final_array);
    return $myBox;

//         $final_Box=[];
//         $image_arrey=[];
//         foreach($detailBoxes as $detailBox)
//       {
//         $MydetailBox =DB::table('products')->where("products.box_id", $detailBox->box_id)->
//          leftJoin('boxes', 'boxes.id', '=', 'products.box_id')->get();

//          foreach($MydetailBox as $MydetailBox1)
//          {
//           array_push($image_arrey,$MydetailBox1->box_image_name);
//          }
//          $detailBox->box_image_name=$image_arrey;
        
//         array_push($final_Box,$detailBox);
//         $image_arrey=[];

//       }

       
// return $final_Box;
       

    }



 private function paginate(array $items, int $perPage = 8, ?int $page = null, $options = []): LengthAwarePaginator
{                                                                                                       
  $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

    $items = $items instanceof Collection ? $items : Collection::make($items);
    return new LengthAwarePaginator(array_values($items->forPage($page, $perPage)
->toArray()), $items->count(), $perPage, $page, $options);
//    return new LengthAwarePaginator($items->forPage($page, $perPage)->toArray(), $items->count(), $perPage, $page, $options);
} 
}
